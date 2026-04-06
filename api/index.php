<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Final version with error output
 */

$tmpDir = sys_get_temp_dir();

$writableDirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
    $tmpDir . '/laravel_bootstrap_cache',
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

$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) { copy($dbPath, $dbTmpPath); }

$_ENV['APP_DEBUG'] = 'true'; $_SERVER['APP_DEBUG'] = 'true';
$_ENV['CACHE_DRIVER'] = 'array'; $_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array'; $_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr'; $_SERVER['LOG_CHANNEL'] = 'stderr';

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($dstCacheDir);
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// Custom exception handler to show real errors
$app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class, function() {
    return new class implements \Illuminate\Contracts\Debug\ExceptionHandler {
        public function report(\Throwable $e) {}
        public function shouldReport(\Throwable $e) { return true; }
        public function render($request, \Throwable $e) {
            http_response_code(500);
            header('Content-Type: text/plain; charset=utf-8');
            echo "=== ORIGINAL EXCEPTION ===\n";
            echo get_class($e) . "\n" . $e->getMessage() . "\n";
            echo $e->getFile() . ":" . $e->getLine() . "\n\n--- Trace ---\n" . $e->getTraceAsString();
            exit;
        }
        public function renderForConsole($output, \Throwable $e) {}
    };
});

try {
    $app->handleRequest(Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "=== FATAL ===\n" . get_class($e) . "\n" . $e->getMessage() . "\n" . $e->getTraceAsString();
}
