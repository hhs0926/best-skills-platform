<?php
/**
 * Vercel Serverless Function entry point for Laravel
 */

$tmpDir = sys_get_temp_dir();

// Create writable storage directories in /tmp
$dirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

// Copy SQLite DB to /tmp
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

// Set critical environment variables before booting
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';
$_ENV['CACHE_DRIVER'] = 'array';
$_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array';
$_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr';
$_SERVER['LOG_CHANNEL'] = 'stderr';
$_ENV['LOG_LEVEL'] = 'debug';
$_SERVER['LOG_LEVEL'] = 'debug';

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    $app->useStoragePath($tmpDir . '/laravel_storage');
    $app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });
    
    // Use L11's built-in handleRequest (lighter than Kernel)
    $app->handleRequest(Illuminate\Http\Request::capture());
    
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "=== LARAVEL ERROR ===\n";
    echo get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "--- Trace ---\n" . $e->getTraceAsString() . "\n";
}
