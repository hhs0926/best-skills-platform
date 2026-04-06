<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * With error debugging
 */

ini_set('display_errors', '1');
error_reporting(E_ALL);

$tmpDir = sys_get_temp_dir();

$writableDirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_bootstrap_cache',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    $app->useStoragePath($tmpDir . '/laravel_storage');
    $app->useBootstrapPath($tmpDir . '/laravel_bootstrap_cache');
    $app->singleton('path.database', function() use ($tmpDir) { return $tmpDir; });
    
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle($request = Illuminate\Http\Request::capture());
    $response->send();
    $kernel->terminate($request, $response);
} catch (\Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "=== ERROR ===\n";
    echo get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "--- Trace ---\n" . $e->getTraceAsString() . "\n\n";
    echo "--- Debug ---\n";
    echo "DB (original): " . (file_exists($dbPath) ? 'YES ('.filesize($dbPath).'b)' : 'NO') . "\n";
    echo "DB (/tmp): " . (file_exists($dbTmpPath) ? 'YES ('.filesize($dbTmpPath).'b)' : 'NO') . "\n";
}
