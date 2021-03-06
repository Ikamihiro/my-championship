<?php

namespace App\Controllers\Api;

use App\Forms\Campeonato\CampeonatoForm;
use App\Models\Campeonato;
use App\Services\CampeonatoService;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;
use Illuminate\Database\Capsule\Manager as Database;
use Illuminate\Database\DatabaseTransactionsManager;

class CampeonatoController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $campeonatos = Campeonato::with([
            'times',
            'patrocinadores',
            'partidas',
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
            'partidas',
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
            'partidas',
        ]));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::with([
            'times',
            'patrocinadores',
            'partidas',
        ])->where('id', $id)->firstOrFail();

        return $response->json($campeonato);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::findOrFail($id);
        $campeonato->delete();
        return $response->noContent();
    }

    public function generatePartidas(Request $request, Response $response, int $id)
    {
        $campeonato = Campeonato::findOrFail($id);

        $campeonatoService = CampeonatoService::mount($campeonato);
        $partidas = $campeonatoService->generatePartidas();

        Database::beginTransaction();

        try {
            foreach ($partidas as $data) {
                $newPartida = $campeonato->partidas()->create($data['partida']);
                $newPartida->resultado()->create($data['resultado']);
                $newPartida->transmissao()->create($data['transmissao']);
            }

            Database::commit();
        } catch (\Throwable $th) {
            Database::rollBack();
            throw $th;
        }

        return $response->json($campeonato->load([
            'times',
            'patrocinadores',
            'partidas',
        ]));
    }
}
