<?php

namespace App\Controllers\Api;

use App\Forms\Jogador\JogadorForm;
use App\Models\Jogador;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class JogadorController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json(Jogador::all());
    }

    public function create(Request $request, Response $response)
    {
        $form = JogadorForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $jogador = Jogador::create($request->getFormJSON());
        return $response->json($jogador);
    }

    public function update (Request $request, Response $response, int $id)
    {
        $jogador = Jogador::findOrFail($id);
        $form = JogadorForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $jogador->update($request->getFormJSON());
        return $response->json($jogador);
    }

    public function show(Request $request, Response $response, int $id)
    {
        return $response->json(Jogador::findOrFail($id));
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $jogador = Jogador::findOrFail($id);
        $jogador->delete();
        return $response->noContent();
    }
    
}