<?php
// Vercel Serverless Function for Laravel - Debug version

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

// Set content type header
header('Content-Type: text/html; charset=utf-8');

try {
    // Check if vendor/autoload.php exists
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoloadPath)) {
        http_response_code(500);
        echo "<h1>Error: vendor/autoload.php not found at: " . htmlspecialchars($autoloadPath) . "</h1>";
        echo "<p>__DIR__ = " . htmlspecialchars(__DIR__) . "</p>";
        echo "<p>CWD = " . htmlspecialchars(getcwd()) . "</p>";
        exit(1);
    }
    
    // Load Composer dependencies
    require_once $autoloadPath;
    
    // Check bootstrap/app.php
    $bootstrapPath = __DIR__ . '/../bootstrap/app.php';
    if (!file_exists($bootstrapPath)) {
        http_response_code(500);
        echo "<h1>Error: bootstrap/app.php not found at: " . htmlspecialchars($bootstrapPath) . "</h1>";
        exit(1);
    }

    // Bootstrap Laravel application
    $app = require_once $bootstrapPath;

    // Create HTTP Kernel instance
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    // Capture the incoming request
    $request = Illuminate\Http\Request::capture();

    // Handle the request through Laravel's HTTP kernel
    $response = $kernel->handle($request);

    // Send the response back to Vercel
    $response->send();

    // Terminate the kernel (cleanup, logging, etc.)
    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(500);
    echo '<h1>Laravel Error</h1>';
    echo '<pre>' . htmlspecialchars((string)$e) . '</pre>';
    echo '<h2>Debug Info</h2>';
    echo '<pre>';
    echo '__DIR__: ' . htmlspecialchars(__DIR__) . "\n";
    echo 'CWD: ' . htmlspecialchars(getcwd()) . "\n";
    echo 'PHP Version: ' . PHP_VERSION . "\n";
    
    // Check database file
    $dbPath = dirname(__DIR__) . '/database/database.sqlite';
    echo 'DB Path: ' . htmlspecialchars($dbPath) . "\n";
    echo 'DB Exists: ' . (file_exists($dbPath) ? 'YES' : 'NO') . "\n";
    
    echo 'APP_KEY: ' . (getenv('APP_KEY') ?: '(not set)') . "\n";
    echo 'APP_ENV: ' . (getenv('APP_ENV') ?: '(not set)') . "\n";
    echo 'DB_CONNECTION: ' . (getenv('DB_CONNECTION') ?: '(not set)') . "\n";
    echo '</pre>';
}
