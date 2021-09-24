<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';

header("Access-Control-Allow-Origin: *");

use App\Controllers\Api\{
    AuthController,
    CidadeController,
    EstadioController,
    EstadoController,
    PresidenteController,
    TimeController,
    UniformeController,
    ArbitroController,
    CorController,
    ArbitragemController,
    ComissaoTecnicaController,
    MembroController
};
use App\Controllers\HomeController;
use App\Middlewares\AuthMiddleware;
use Lib\Application;

$app = new Application();

$app->router->get('/', [HomeController::class, 'index']);

$app->router->post('/register', [AuthController::class, 'register']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->apiRoutes('/api/estado', EstadoController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/cidade', CidadeController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/cor', CorController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/time', TimeController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/presidente', PresidenteController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/estadio', EstadioController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/uniforme', UniformeController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/comissao', ComissaoTecnicaController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/membro', MembroController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/arbitro', ArbitroController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/arbitragem', ArbitragemController::class, AuthMiddleware::class);

$app->run();
