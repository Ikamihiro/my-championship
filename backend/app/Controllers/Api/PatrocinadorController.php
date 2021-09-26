<?php

namespace App\Controllers\Api;

use App\Forms\Patrocinador\PatrocinadorForm;
use App\Models\Patrocinador;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class PatrocinadorController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $patrocinadores = Patrocinador::with('campeonatos')
            ->orderBy('created_at', 'desc')
            ->get();

        return $response->json($patrocinadores);
    }

    public function create(Request $request, Response $response)
    {
        $form = PatrocinadorForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $patrocinador = Patrocinador::create($request->getFormJSON());

        return $response->json($patrocinador->load('campeonatos'));
    }

    public function update(Request $request, Response $response, int $id)
    {
        $patrocinador = Patrocinador::findOrFail($id);

        $form = PatrocinadorForm::make($request->getFormJSON());
        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $patrocinador->update($request->getFormJSON());

        return $response->json($patrocinador->load('campeonatos'));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $patrocinador = Patrocinador::with('campeonatos')
            ->where('id', $id)
            ->firstOrFail();
        return $response->json($patrocinador);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $patrocinador = Patrocinador::findOrFail($id);
        $patrocinador->delete();
        return $response->json($patrocinador);
    }
}
