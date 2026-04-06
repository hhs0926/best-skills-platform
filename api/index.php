<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirecting writable paths to /tmp
 */

$tmpDir = sys_get_temp_dir();

// Create writable directories in /tmp (Vercel Lambda has read-only fs except /tmp)
$writableDirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_bootstrap_cache',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy SQLite database to /tmp (Lambda's only writable location for DB)
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Boot Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override paths for Vercel's read-only filesystem
$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($tmpDir . '/laravel_bootstrap_cache');

// Make Laravel look for the DB in /tmp
$app->singleton('path.database', function() use ($tmpDir) {
    return $tmpDir;
});

// Handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
