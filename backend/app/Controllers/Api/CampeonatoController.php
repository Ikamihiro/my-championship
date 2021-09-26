<?php

namespace App\Controllers\Api;

use App\Forms\Campeonato\CampeonatoForm;
use App\Models\Campeonato;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class CampeonatoController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $campeonatos = Campeonato::with([
            'times',
            'patrocinadores',
        ])->orderBy('created_at', 'desc')->get();

        return $response->json($campeonatos);
    }

    public function create(Request $request, Response $response)
    {
        $form = CampeonatoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $campeonato = Campeonato::create($request->getFormJSON());

        if ($request->getFormJSON()['times']) {
            $campeonato->times()->sync($request->getFormJSON()['times']);
        }

        if ($request->getFormJSON()['patrocinadores']) {
            $campeonato->patrocinadores()->sync($request->getFormJSON()['patrocinadores']);
        }

        return $response->json($campeonato->load([
            'times',
            'patrocinadores',
        ]));
    }

    public function update(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::findOrFail($id);
        $form = CampeonatoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $campeonato->update($request->getFormJSON());

        if ($request->getFormJSON()['times']) {
            $campeonato->times()->sync($request->getFormJSON()['times']);
        }

        if ($request->getFormJSON()['patrocinadores']) {
            $campeonato->patrocinadores()->sync($request->getFormJSON()['patrocinadores']);
        }

        return $response->json($campeonato->load([
            'times',
            'patrocinadores',
        ]));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::with([
            'times',
            'patrocinadores',
        ])->where('id', $id)->firstOrFail();

        return $response->json($campeonato);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::findOrFail($id);
        $campeonato->delete();
        return $response->noContent();
    }
}
