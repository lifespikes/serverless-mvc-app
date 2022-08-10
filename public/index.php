<?php

use LifeSpikes\Controllers\HomeController;
use LifeSpikes\Controllers\UsersController;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = [
    '/' => [
        'GET' => [HomeController::class, 'index']
    ],

    '/users' => [
        'GET' => [UsersController::class, 'index'],
        'POST' => [UsersController::class, 'store']
    ],

    '/users/create' => [
        'GET' => [UsersController::class, 'create']
    ]
];

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if (isset($routes[$uri])) {
    if (!isset($routes[$uri][$method])) {
        http_response_code(405);
        echo 'Method not allowed';
        exit;
    }

    [$controller, $method] = $routes[$uri][$method];
    echo (new $controller())->$method();
} else {
    http_response_code(404);
    echo "Not found";
}
