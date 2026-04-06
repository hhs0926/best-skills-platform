<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirecting writable paths to /tmp
 */

// Suppress tempnam() warnings (Vercel Lambda treats warnings as errors)
set_error_handler(function($errno, $errstr) {
    // Allow tempnam() and similar filesystem warnings silently
    if (strpos($errstr, 'tempnam') !== false || strpos($errstr, 'tmpfile') !== false) {
        return true; // Suppress this specific warning
    }
    return false; // Let other errors through normally
});

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

// Copy bootstrap/cache files to /tmp (PackageManifest needs write access)
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

// Set environment variables cleanly in code (Vercel env vars have BOM issues)
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

// Handle the request with custom exception handler to show REAL errors (not Laravel's view-based error page)
try {
    $response = $app->handleRequest(Illuminate\Http\Request::capture());
    $response->send();
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    
    // Build a clean error page that shows the REAL original error
    $errorClass = get_class($e);
    $errorMessage = $e->getMessage();
    $errorFile = $e->getFile();
    $errorLine = $e->getLine();
    $traceHtml = '';
    
    foreach ($e->getTrace() as $i => $frame) {
        $file = isset($frame['file']) ? $frame['file'] : '(internal)';
        $line = isset($frame['line']) ? $frame['line'] : '?';
        $class = isset($frame['class']) ? $frame['class'] : '';
        $type = isset($frame['type']) ? $frame['type'] : '';
        $func = isset($frame['function']) ? $frame['function'] : '';
        $traceHtml .= "<tr><td>#{$i}</td><td>" . htmlspecialchars($class . $type . $func) . "</td>";
        $traceHtml .= "<td>" . htmlspecialchars($file) . ":{$line}</td></tr>\n";
    }
    
    echo <<<HTML
<!DOCTYPE html>
<html><head><title>Laravel Error - {$errorClass}</title>
<style>body{font-family:monospace;padding:20px;background:#1a1a2e;color:#eee}
h1{color:#e94560}.error{background:#16213e;padding:15px;border-radius:8px;margin:10px 0}
table{width:100%;border-collapse:collapse}td{padding:4px 8px;border-bottom:1px #333 solid;font-size:13px}</style>
</head><body>
<h1>{$errorClass}</h1>
<div class="error"><strong>Message:</strong> {$errorMessage}<br><strong>File:</strong> {$errorFile}:{$errorLine}</div>
<h3>Stack Trace</h3><table>{$traceHtml}</table>
</body></html>
HTML;
}
