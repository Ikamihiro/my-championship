<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';

use Lib\Application;

$app = new Application();

$app->router->get('/', [\App\Controllers\HomeController::class, 'index']);

$app->router->post('/register', [\App\Controllers\Api\AuthController::class, 'register']);
$app->router->post('/login', [\App\Controllers\Api\AuthController::class, 'login']);

$app->run();
