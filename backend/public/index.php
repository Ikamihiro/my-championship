<?php

if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo 'Error Autoload';
    exit(1);
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/helpers.php';
require_once __DIR__ . '/../config/env.php';
require_once __DIR__ . '/../config/database.php';

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, PATCH");

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
    CampeaoController,
    CampeonatoController,
    ComissaoTecnicaController,
    MembroController,
    PatrocinadorController
};
use App\Controllers\HomeController;
use App\Middlewares\AuthMiddleware;
use Lib\Application;
use Lib\Http\Request;
use Lib\Http\Response;

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
$app->router->apiRoutes('/api/campeonato', CampeonatoController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/patrocinador', PatrocinadorController::class, AuthMiddleware::class);
$app->router->apiRoutes('/api/campeao', CampeaoController::class, AuthMiddleware::class);

$app->router->get('/api/time/estadio/{timeId}', [
    TimeController::class, 'getEstadio',
])->addMiddleware(AuthMiddleware::class);

$app->router->get('/api/time/presidente/{timeId}', [
    TimeController::class, 'getPresidente',
])->addMiddleware(AuthMiddleware::class);

$app->router->get('/api/time/uniforme/{timeId}', [
    TimeController::class, 'getUniforme',
])->addMiddleware(AuthMiddleware::class);

$app->router->get('/api/time/cores/{timeId}', [
    TimeController::class, 'getCores',
])->addMiddleware(AuthMiddleware::class);

$app->router->post('/api/time/cores/{timeId}', [
    TimeController::class, 'saveCores',
])->addMiddleware(AuthMiddleware::class);

$app->router->post('/api/campeonato/generate_partidas/{id}', [
    CampeonatoController::class, 'generatePartidas',
])->addMiddleware(AuthMiddleware::class);

$app->run();
