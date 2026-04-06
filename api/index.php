<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Shows the ORIGINAL exception (not the error-rendering failure)
 */

$tmpDir = sys_get_temp_dir();

$dirs = [
    $tmpDir . '/laravel_storage', $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views', $tmpDir . '/laravel_storage/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) { copy($dbPath, $dbTmpPath); }

$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';
$_ENV['CACHE_DRIVER'] = 'array'; $_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array'; $_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr'; $_SERVER['LOG_CHANNEL'] = 'stderr';

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($tmpDir . '/laravel_storage');
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// Register a custom error handler that shows the REAL original exception
// by disabling view-based exception rendering
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
    echo "=== FATAL ERROR ===\n";
    echo get_class($e) . "\n" . $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n\n--- Trace ---\n" . $e->getTraceAsString();
}
