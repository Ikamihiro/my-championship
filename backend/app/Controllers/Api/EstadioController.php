<?php

namespace App\Controllers\Api;

use App\Forms\Estadio\EstadioForm;
use App\Models\Estadio;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class EstadioController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $estadios = Estadio::orderBy('created_at', 'desc')->get();

        return $response->json($estadios);
    }

    public function create(Request $request, Response $response)
    {
        $form = EstadioForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $estadio = Estadio::create($request->getFormJSON());
        return $response->json($estadio);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $estadio = Estadio::findOrFail($id);
        $form = EstadioForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $estadio->update($request->getFormJSON());
        return $response->json($estadio);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $estadio = Estadio::findOrFail($id);
        return $response->json($estadio);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $estadio = Estadio::findOrFail($id);
        $estadio->delete();
        return $response->noContent();
    }

    public function getByTime(Request $request, Response $response, int $timeId)
    {
        $estadio = Estadio::where('time_id', $timeId)->first();

        return $response->json($estadio);
    }
}
