<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Forwards all requests to Laravel's public/index.php
 */

// Capture all output and errors
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Set up writable directories for Vercel's read-only filesystem
$tmpDir = sys_get_temp_dir();

// Create required writable directories in /tmp
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

// Check if database file exists and copy to /tmp if needed
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

// Load Laravel
try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    
    // Override storage and bootstrap/cache paths BEFORE kernel handles request
    if (is_callable([$app, 'useStoragePath'])) {
        $app->useStoragePath($tmpDir . '/laravel_storage');
    }
    
    // Handle the request
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    
    $response->send();
    
    $kernel->terminate($request, $response);
    
} catch (\Throwable $e) {
    // Return detailed error info for debugging
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    
    echo "=== LARAVEL ERROR ===\n";
    echo "Error: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "--- Trace ---\n" . $e->getTraceAsString() . "\n\n";
    
    echo "--- Debug Info ---\n";
    echo "CWD: " . getcwd() . "\n";
    echo "__DIR__: " . __DIR__ . "\n";
    echo "DB exists (original): " . (file_exists($dbPath) ? 'YES (' . filesize($dbPath) . ' bytes)' : 'NO') . "\n";
    echo "DB exists (/tmp): " . (file_exists($dbTmpPath) ? 'YES (' . filesize($dbTmpPath) . ' bytes)' : 'NO') . "\n";
    echo "bootstrap/app.php exists: " . (file_exists(__DIR__ . '/../bootstrap/app.php') ? 'YES' : 'NO') . "\n";
    echo "public/index.php exists: " . (file_exists(__DIR__ . '/../public/index.php') ? 'YES' : 'NO') . "\n";
}
