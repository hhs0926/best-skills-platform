<?php
// Vercel Serverless Function for Laravel

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');

// Load Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel application
$app = require_once __DIR__ . '/../bootstrap/app.php';

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
