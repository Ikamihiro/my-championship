<?php

namespace App\Controllers\Api;

use App\Models\Partida;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class PartidaController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json(Partida::with(['mandante', 'visitante', 'campeonato', 'resultado', 'transmissao', 'arbitragem'])->get());
    }


}