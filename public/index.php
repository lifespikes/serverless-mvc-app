<?php

use LifeSpikes\Controllers\HomeController;
use LifeSpikes\Controllers\UsersController;
use \LifeSpikes\Support\Redis;

require_once __DIR__ . '/../vendor/autoload.php';

/* Set Redis as our session handler */
Redis::handleSessions();

/* Register our routes */
$routes = [
    '/' => [
        'GET' => [HomeController::class, 'index']
    ],

    '/users' => [
        'GET' => fn () => layout('master', 'users'),
        'POST' => [UsersController::class, 'signup']
    ],

    '/users/signup' => [
        'GET' => fn () => layout('master', 'auth/signup'),
    ],

    '/users/login' => [
        'GET' => fn () => layout('master', 'auth/login'),
        'POST' => [UsersController::class, 'login']
    ],
];

function handle(): string
{
    global $routes;

    /* Handle the request */
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    if (isset($routes[$uri])) {
        if (!isset($routes[$uri][$method])) {
            http_response_code(405);
            return 'Method not allowed';
        }

        /* Execute closure or controller method */
        $route = $routes[$uri][$method];

        if (is_callable($route)) {
            return $route();
        }

        [$controller, $method] = $route;
        return (new $controller())->$method();
    } else {
        http_response_code(404);
        return 'Not found';
    }
}

echo handle();
