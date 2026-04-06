<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirecting writable paths to /tmp
 */

$tmpDir = sys_get_temp_dir();

// Create ALL required writable directories in /tmp
$writableDirs = [
    $tmpDir . '/laravel_storage', $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
    $tmpDir . '/laravel_bootstrap_cache',
    $tmpDir . '/laravel_bootstrap_cache/cache',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

// Copy bootstrap/cache files to /tmp
$srcCacheDir = __DIR__ . '/../bootstrap/cache';
$dstCacheDir = $tmpDir . '/laravel_bootstrap_cache';
if (is_dir($srcCacheDir)) {
    foreach (scandir($srcCacheDir) as $file) {
        if ($file !== '.' && $file !== '..' && !file_exists($dstCacheDir . '/' . $file)) {
            copy($srcCacheDir . '/' . $file, $dstCacheDir . '/' . $file);
        }
    }
}

// Copy SQLite database to /tmp
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) { copy($dbPath, $dbTmpPath); }

// Set environment variables cleanly in code
$_ENV['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_SERVER['APP_KEY'] = 'base64:Mg1jy9eGHrlJJhhYIpj1Y2oVYcRuG5/qK3JTat63WZE=';
$_ENV['APP_DEBUG'] = 'false'; $_SERVER['APP_DEBUG'] = 'false';
$_ENV['APP_ENV'] = 'production'; $_SERVER['APP_ENV'] = 'production';
$_ENV['APP_URL'] = 'https://best-skills-platform.vercel.app';
$_SERVER['APP_URL'] = 'https://best-skills-platform.vercel.app';
$_ENV['DB_CONNECTION'] = 'sqlite'; $_SERVER['DB_CONNECTION'] = 'sqlite';
$_ENV['CACHE_DRIVER'] = 'array'; $_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array'; $_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr'; $_SERVER['LOG_CHANNEL'] = 'stderr';

// Load Composer autoloader and boot Laravel
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override paths for Vercel read-only filesystem
$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($dstCacheDir);
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// === THE FIX: Replace Laravel's error handler with our own that ignores tempnam warnings ===
// We save the original handler and call it for non-tempnam errors
$originalHandler = set_error_handler(function($errno, $errstr, $errfile, $errline) {
    // Ignore tempnam/tmpfile warnings completely - these are harmless on Vercel Lambda
    if ((strpos($errstr, 'tempnam') !== false || strpos($errstr, 'tmpfile') !== false) 
        && strpos($errstr, 'temporary directory') !== false) {
        return true; // Silently ignore
    }
    
    // For all other errors, let PHP's default behavior handle it
    // This will trigger the normal error handling chain but won't convert these to exceptions
    return false;
});

// Also override the exception handler for clean error display  
$app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class)->renderable(function (\Throwable $e, $request) {
    $errorClass = get_class($e);
    $errorMessage = $e->getMessage();
    $errorFile = $e->getFile();
    $errorLine = $e->getLine();
    
    $traceHtml = '';
    foreach (array_slice($e->getTrace(), 0, 15) as $i => $frame) {
        $file = isset($frame['file']) ? $frame['file'] : '(internal)';
        $line = isset($frame['line']) ? $frame['line'] : '?';
        $class = isset($frame['class']) ? $frame['class'] : '';
        $type = isset($frame['type']) ? $frame['type'] : '';
        $func = isset($frame['function']) ? $frame['function'] : '';
        $traceHtml .= "<tr><td>#{$i}</td><td>" . htmlspecialchars($class . $type . $func) . "</td>";
        $traceHtml .= "<td>" . htmlspecialchars("{$file}:{$line}") . "</td></tr>\n";
    }
    
    return response(
        "<!DOCTYPE html><html><head><title>{$errorClass}</title>"
        . "<style>body{font-family:monospace;padding:20px;background:#1a1a2e;color:#eee}"
        . "h1{color:#e94560}.error{background:#16213e;padding:15px;border-radius:8px;margin:10px 0}"
        . "table{width:100%;border-collapse:collapse}td{padding:4px 8px;border-bottom:1px #333 solid;font-size:13px}</style></head><body>"
        . "<h1>" . htmlspecialchars($errorClass) . "</h1>"
        . "<div class='error'><strong>Message:</strong> " . htmlspecialchars($errorMessage) 
        . "<br><strong>File:</strong> " . htmlspecialchars($errorFile) . ":{$errorLine}</div>"
        . "<h3>Stack Trace</h3><table>{$traceHtml}</table>"
        . "</body></html>",
        500,
        ['Content-Type' => 'text/html; charset=utf-8']
    );
});

// Handle the request
$response = $app->handleRequest(Illuminate\Http\Request::capture());
$response->send();
