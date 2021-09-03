<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/env.php';
require __DIR__ . '/../config/database.php';

use Lib\Application;

$app = new Application();

$app->router->get('/', [\App\Controllers\HomeController::class, 'index']);

$app->router->post('/register', [\App\Controllers\Api\AuthController::class, 'register']);
$app->router->post('/login', [\App\Controllers\Api\AuthController::class, 'login']);

$app->router->get('/hello/{name}', [\App\Controllers\HomeController::class, 'hello'])->addMiddleware(\App\Middlewares\AuthMiddleware::class);

$app->run();
