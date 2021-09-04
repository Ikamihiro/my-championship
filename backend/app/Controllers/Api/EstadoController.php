<?php

namespace App\Controllers\Api;

use App\Forms\Auth\EstadoForm;
use App\Models\Estado;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class EstadoController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $estados = Estado::all();
        return $response->json($estados);
    }

    public function create(Request $request, Response $response)
    {
        $form = EstadoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                'errors' => $form->getErrors(),
            ], 400);
        }

        $estado = Estado::create($request->getFormJSON());

        return $response->json($estado);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $estado = Estado::findOrFail($id);
        $form = EstadoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                'errors' => $form->getErrors(),
            ], 400);
        }

        $estado->update($request->getFormJSON());

        return $response->json($estado);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $estado = Estado::findOrFail($id);
        return $response->json($estado);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $estado = Estado::findOrFail($id);
        $estado->delete();
        return $response->noContent();
    }
}
