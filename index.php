<?php

// Serve static files if using PHP built-in server
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
        return false;
    }
}

session_start();

// Enable Error Reporting for Debugging (Disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define BASE_URL for dynamic asset loading
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$scriptPath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$scriptPath = rtrim($scriptPath, '/');
define('BASE_URL', $protocol . '://' . $host . $scriptPath);

// Simple Autoloader
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Core\Config;
use App\Core\Router;

// Load config
Config::load(__DIR__ . '/.env');

// Initialize Router
$router = new Router();

// Routes
$router->add('GET', '/', 'PaymentController@index');
$router->add('POST', '/invoice/create', 'PaymentController@create');
$router->add('GET', '/success', 'PaymentController@success');
$router->add('POST', '/api/webhook', 'PaymentController@webhook');

// Admin Routes
$router->add('GET', '/admin/login', 'AdminController@login');
$router->add('POST', '/admin/auth', 'AdminController@auth');
$router->add('GET', '/admin/dashboard', 'AdminController@dashboard');
$router->add('GET', '/admin/logout', 'AdminController@logout');

// Dispatch
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
