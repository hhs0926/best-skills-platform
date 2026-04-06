<?php
// Vercel Serverless Function for Laravel
// Handles read-only filesystem of Vercel Lambda

// === 1. Fix: Create writable directories in /tmp (only writable path on Vercel) ===
$storagePath = sys_get_temp_dir() . '/laravel_storage';
$cachePath = sys_get_temp_dir() . '/laravel_cache';

if (!is_dir($storagePath)) {
    mkdir($storagePath . '/logs', 0777, true);
    mkdir($storagePath . '/framework/cache/data', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
}

if (!is_dir($cachePath)) {
    mkdir($cachePath, 0777, true);
}

// Override Laravel's storage and cache paths BEFORE bootstrapping
if (!defined('LARAVEL_STORAGE_PATH')) {
    define('LARAVEL_STORAGE_PATH', $storagePath);
    define('LARAVEL_CACHE_PATH', $cachePath);
}

// === 2. Load Composer dependencies ===
require_once __DIR__ . '/../vendor/autoload.php';

// === 3. Bootstrap Laravel application (before kernel, so we can fix paths) ===
$app = require_once __DIR__ . '/../bootstrap/app.php';

// === 4. Override storage path after app creation but before handling request ===
$app->useStoragePath($storagePath);

// Ensure bootstrap/cache exists and is writable for config cache etc.
if (!is_dir(__DIR__ . '/../bootstrap/cache')) {
    // Can't write to bootstrap in read-only system - disable config caching
    putenv('APP_MAINTENANCE_DISABLE=true');
}

// === 5. Handle the HTTP request ===
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
