<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Working version - all env vars set cleanly in code
 */

$tmpDir = sys_get_temp_dir();

// Create ALL required writable directories
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

// Copy bootstrap/cache files
$srcCacheDir = __DIR__ . '/../bootstrap/cache';
$dstCacheDir = $tmpDir . '/laravel_bootstrap_cache';
if (is_dir($srcCacheDir)) {
    foreach (scandir($srcCacheDir) as $file) {
        if ($file !== '.' && $file !== '..' && !file_exists($dstCacheDir . '/' . $file)) {
            copy($srcCacheDir . '/' . $file, $dstCacheDir . '/' . $file);
        }
    }
}

// Copy SQLite DB
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) { copy($dbPath, $dbTmpPath); }

// Set ALL environment variables cleanly (bypass Vercel's BOM-corrupted env vars)
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
$_ENV['VIEW_COMPILED_PATH'] = $tmpDir . '/laravel_storage/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $tmpDir . '/laravel_storage/framework/views';

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($dstCacheDir);
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// Custom exception handler
$app->singleton(\Illuminate\Contracts\Debug\ExceptionHandler::class, function() {
    return new class implements \Illuminate\Contracts\Debug\ExceptionHandler {
        public function report(\Throwable $e) {}
        public function shouldReport(\Throwable $e) { return true; }
        public function render($request, \Throwable $e) {
            http_response_code(500);
            header('Content-Type: text/plain; charset=utf-8');
            echo "=== ERROR ===\n" . get_class($e) . "\n" . $e->getMessage() . "\n";
            echo $e->getFile() . ":" . $e->getLine() . "\n\n--- Trace ---\n";
            $t = $e->getTrace(); foreach(array_slice($t, 0, 8) as $i => $l) echo "#$i {$l['file']}:{$l['line']} -> {$l['function']}\n";
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
    echo "=== FATAL ===\n" . get_class($e) . "\n" . $e->getMessage() . "\n" . substr($e->getTraceAsString(), 0, 1000);
}
