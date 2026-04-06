<?php
/**
 * Vercel Serverless Function for Laravel
 * 
 * Vercel Lambda uses a READ-ONLY filesystem (except /tmp).
 * This entry point handles all the path/permission issues.
 */

// ============================================
// PHASE 0: Pre-Laravel bootstrap fixes
// ============================================

$tmpDir = sys_get_temp_dir();

// Create writable directories in /tmp
$storagePath = $tmpDir . '/laravel_storage';
$bootstrapCachePath = $tmpDir . '/laravel_bootstrap_cache';

$dirs = [
    $storagePath,
    $storagePath . '/logs',
    $storagePath . '/framework',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/cache/data',  
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/app/public',
    $bootstrapCachePath,
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) { @mkdir($dir, 0755, true); }
}

// Copy SQLite DB to /tmp if it exists in project (read-only source)
$dbSource = __DIR__ . '/../database/database.sqlite';
$dbTarget = $tmpDir . '/laravel_database.sqlite';
if (file_exists($dbSource) && !file_exists($dbTarget)) {
    @copy($dbSource, $dbTarget);
}
if (!file_exists($dbTarget)) {
    // Try to create an empty one and seed it
    @touch($dbTarget);
}

// Override Laravel's path constants BEFORE any Laravel code loads
define('LARAVEL_START', microtime(true));
define('LARAVEL_STORAGE_PATH', $storagePath);

// Set env var so database config picks up our moved DB file
$_ENV['DB_DATABASE'] = file_exists($dbTarget) ? $dbTarget : $dbSource;
$_SERVER['DB_DATABASE'] = $_ENV['DB_DATABASE'];
putenv('DB_DATABASE=' . $_ENV['DB_DATABASE']);

// Disable log writing to avoid read-only filesystem errors  
putenv('LOG_CHANNEL=null');
putenv('LOG_LEVEL=emergency');

// ============================================
// PHASE 1: Load Composer & Bootstrap Laravel
// ============================================
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override storage path via app instance
$app->useStoragePath($storagePath);

// Make sure config cache dir points to writable location
$app->useLangPath(__DIR__ . '/../resources/lang');

// ============================================  
// PHASE 2: Handle HTTP request
// ============================================
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();

try {
    $response = $kernel->handle($request);
    $response->send();
} catch (\Throwable $e) {
    // Last-resort error handler - output plain text error
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Error: " . get_class($e) . "\n";
    echo $e->getMessage() . "\n\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "Debug:\n";
    echo "PHP: " . PHP_VERSION . "\n";
    echo "CWD: " . getcwd() . "\n";
    echo "__DIR__: " . __DIR__ . "\n";
    echo "Storage: " . $storagePath . " (exists:" . (is_dir($storagePath)?'Y':'N') . ")\n";
    echo "DB Source: $dbSource (exists:" . (file_exists($dbSource)?'Y':'N') . ")\n";
    echo "DB Target: $dbTarget (exists:" . (file_exists($dbTarget)?'Y':'N') . ")\n";
    echo "APP_KEY: " . (getenv('APP_KEY') ?: '(not set)') . "\n";
}

$kernel->terminate($request, $response ?? null);
