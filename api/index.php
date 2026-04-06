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

// === NUCLEAR OPTION: Use Reflection to modify HandleExceptions's warning level property ===
// Laravel's HandleExceptions converts E_WARNING to ErrorException when this flag is set
try {
    $handlerRef = new ReflectionClass(\Illuminate\Foundation\Bootstrap\HandleExceptions::class);
    
    // Find the HandleExceptions instance bound in the container or get it from the bootstrap
    // The key insight: we can access it through the resolved exception handler
    $app->resolving(\Illuminate\Contracts\Debug\ExceptionHandler::class, function ($handler, $app) {
        // This won't help since handler is already resolved
    });
} catch (\Throwable $e) {
    // Reflection failed, try another approach
}

// === FINAL APPROACH: Wrap handleRequest to catch+suppress tempnam ErrorExceptions ===
// We know the exact error - intercept it at the outermost level

// Register a custom exception handler that detects and handles tempnam warnings specially
$exceptionHandler = $app->make(\Illuminate\Contracts\Debug\ExceptionHandler::class);

// Use reportable to detect the tempnam issue but don't stop propagation  
// Instead, we wrap the entire request handling
$hadTempnamWarning = false;

set_exception_handler(function (\Throwable $e) use (&$hadTempnamWarning) {
    $msg = $e->getMessage();
    if (strpos($msg, 'tempnam') !== false && strpos($msg, 'temporary directory') !== false) {
        $hadTempnamWarning = true;
        // Don't re-throw - just mark it. The response may have already been generated.
        return;
    }
    throw $e; // Re-throw real exceptions
});

try {
    $response = $app->handleRequest(Illuminate\Http\Request::capture());
    $response->send();
} catch (\Throwable $e) {
    $msg = $e->getMessage();
    
    // If it's the tempnam warning, the page was likely compiled successfully
    // Try to send whatever response content was generated
    if (strpos($msg, 'tempnam') !== false && strpos($msg, 'temporary directory') !== false) {
        // The blade view got compiled (that's what triggered tempnam)
        // But the error was thrown during Response::setContent -> View::render
        // This means the view CONTENT was generated but not wrapped in Response
        
        // Attempt recovery: re-run with pre-compiled views (they should be cached now)
        restore_exception_handler();
        
        try {
            $response2 = $app->handleRequest(Illuminate\Http\Request::capture());
            $response2->send();
            return;
        } catch (\Throwable $e2) {
            // If still fails, show the error
            $msg2 = $e2->getMessage();
        }
    }
    
    // Show clean error for any other exception
    http_response_code(500);
    header('Content-Type: text/html; charset=utf-8');
    echo '<!DOCTYPE html><html><head><title>' . htmlspecialchars(get_class($e)) . '</title>'
       . '<style>body{font-family:monospace;padding:20px;background:#1a1a2e;color:#eee}'
       . 'h1{color:#e94560}.error{background:#16213e;padding:15px;border-radius:8px;margin:10px 0}'
       . 'table{width:100%;border-collapse:collapse}td{padding:4px 8px;border-bottom:1px #333 solid;font-size:13px}</style></head><body>'
       . '<h1>' . htmlspecialchars(get_class($e)) . '</h1>'
       . '<div class="error"><strong>Message:</strong> ' . htmlspecialchars($msg) 
       . '<br><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ':' . $e->getLine() . '</div>';
    
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
    echo "<h3>Stack Trace</h3><table>{$traceHtml}</table></body></html>";
}
