<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Handles Vercel's read-only filesystem by redirectoning writable paths to /tmp
 */

$tmpDir = sys_get_temp_dir();

// Create writable storage directories in /tmp
$writableDirs = [
    $tmpDir . '/laravel_storage',
    $tmpDir . '/laravel_storage/framework',
    $tmpDir . '/laravel_storage/framework/cache/data',
    $tmpDir . '/laravel_storage/framework/sessions', 
    $tmpDir . '/laravel_storage/framework/views',
    $tmpDir . '/laravel_storage/logs',
];
foreach ($writableDirs as $dir) {
    if (!is_dir($dir)) { mkdir($dir, 0755, true); }
}

// Copy SQLite database to /tmp
$dbPath = __DIR__ . '/../database/database.sqlite';
$dbTmpPath = $tmpDir . '/database.sqlite';
if (file_exists($dbPath) && !file_exists($dbTmpPath)) {
    copy($dbPath, $dbTmpPath);
}

// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Boot Laravel application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Only override storage path (keep bootstrap/cache as original - it's pre-compiled)
$app->useStoragePath($tmpDir . '/laravel_storage');

// Override DB path to use /tmp copy
$app->singleton('path.database', function() use ($tmpDir) {
    return $tmpDir;
});

// Handle the request
try {
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
    echo "--- Trace (first 10) ---\n";
    $trace = $e->getTrace();
    foreach (array_slice($trace, 0, 10) as $i => $t) {
        $file = $t['file'] ?? 'unknown';
        $line = $t['line'] ?? '0';
        $func = $t['function'] ?? 'unknown';
        echo "#$i $file:$line -> $func\n";
    }
}
