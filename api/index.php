<?php
/**
 * Vercel Serverless Function entry point for Laravel
 * Debug: Show file system structure
 */

ini_set('display_errors', '1');
error_reporting(E_ALL);

http_response_code(200);
header('Content-Type: text/plain; charset=utf-8');

echo "=== FILE SYSTEM DEBUG ===\n";
echo "CWD: " . getcwd() . "\n";
echo "__DIR__: " . __DIR__ . "\n\n";

echo "=== PARENT DIR STRUCTURE ===\n";
$parent = __DIR__ . '/..';
if (is_dir($parent)) {
    foreach (scandir($parent) as $item) {
        if ($item !== '.' && $item !== '..') {
            $full = $parent . '/' . $item;
            $type = is_dir($full) ? 'DIR' : 'FILE';
            $size = is_file($full) ? filesize($full) : '-';
            echo "  [$type] $item ($size)\n";
        }
    }
} else {
    echo "  Parent dir not found!\n";
}

echo "\n=== CHECKING CRITICAL FILES ===\n";
$checks = [
    '/../bootstrap/app.php',
    '/../composer.json',
    '/../vendor/autoload.php', 
    '/../vendor/laravel/framework/src/Illuminate/Foundation/Application.php',
    '/../public/index.php',
    '/../database/database.sqlite',
];
foreach ($checks as $check) {
    $path = __DIR__ . $check;
    echo "  $check => " . (file_exists($path) ? 'EXISTS (' . (is_file($path) ? filesize($path) . 'b' : 'dir') . ')' : 'MISSING') . "\n";
}

echo "\n=== LAMBDA ENV ===\n";
echo "DOCUMENT_ROOT: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'not set') . "\n";
echo "HOME: " . ($_ENV['HOME'] ?? getenv('HOME') ?? 'not set') . "\n";

// Try to find vendor anywhere
echo "\n=== SEARCHING FOR vendor ===\n";
$root = realpath(__DIR__ . '/..');
function findVendor($dir, $depth = 0) {
    if ($depth > 4) return;
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = $dir . '/' . $item;
        if ($item === 'vendor' && is_dir($path)) {
            echo "  Found: $path (has autoload: " . (file_exists($path . '/autoload.php') ? 'YES' : 'NO') . ")\n";
        } elseif (is_dir($path)) {
            findVendor($path, $depth + 1);
        }
    }
}
findVendor($root);
echo "/var/task/vendor => " . (is_dir('/var/task/vendor') ? 'DIR EXISTS' : 'not found') . "\n";
echo "/var/task/user/vendor => " . (is_dir('/var/task/user/vendor') ? 'DIR EXISTS' : 'not found') . "\n";

// Check if we can require bootstrap
echo "\n=== REQUIRE TEST ===\n";
try {
    // First try loading vendor autoload
    $autoloadLocations = [
        __DIR__ . '/../vendor/autoload.php',
        '/var/task/vendor/autoload.php',
        '/var/task/user/vendor/autoload.php',
    ];
    $loaded = false;
    foreach ($autoloadLocations as $al) {
        if (file_exists($al)) {
            require_once $al;
            echo "  Loaded autoload from: $al\n";
            $loaded = true;
            break;
        }
    }
    if (!$loaded) {
        echo "  ERROR: No vendor/autoload.php found anywhere!\n";
        echo "  Searched:\n";
        foreach ($autoloadLocations as $al) {
            echo "    - $al => " . (file_exists($al) ? 'exists' : 'missing') . "\n";
        }
    }
} catch (\Throwable $e) {
    echo "  Autoload error: " . $e->getMessage() . "\n";
}
