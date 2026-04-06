<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Final working version - handles ALL read-only filesystem issues
 */

$tmpDir = sys_get_temp_dir();

// Create ALL required writable directories in /tmp
$writableDirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
    // CRITICAL: bootstrap/cache MUST be writable too (PackageManifest writes here!)
    $tmpDir . '/laravel_bootstrap_cache',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

// Copy existing bootstrap/cache files to /tmp so Laravel can find them
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
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

// Set environment variables for serverless
$_ENV['APP_DEBUG'] = 'false'; $_SERVER['APP_DEBUG'] = 'false';
$_ENV['CACHE_DRIVER'] = 'array'; $_SERVER['CACHE_DRIVER'] = 'array';
$_ENV['SESSION_DRIVER'] = 'array'; $_SERVER['SESSION_DRIVER'] = 'array';
$_ENV['LOG_CHANNEL'] = 'stderr'; $_SERVER['LOG_CHANNEL'] = 'stderr';
$_ENV['VIEW_COMPILED_PATH'] = $tmpDir . '/laravel_storage/framework/views';
$_SERVER['VIEW_COMPILED_PATH'] = $tmpDir . '/laravel_storage/framework/views';

// Load autoloader and boot Laravel
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override paths for Vercel's read-only filesystem
$app->useStoragePath($tmpDir . '/laravel_storage');
$app->useBootstrapPath($dstCacheDir); // Point bootstrap/cache to writable /tmp!
$app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });

// Handle the request
$app->handleRequest(Illuminate\Http\Request::capture());
