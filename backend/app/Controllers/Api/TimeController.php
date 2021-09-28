<?php

namespace App\Controllers\Api;

use App\Forms\Time\TimeForm;
use App\Models\Cor;
use App\Models\Estadio;
use App\Models\Presidente;
use App\Models\Time;
use App\Models\Uniforme;
use Illuminate\Database\Eloquent\Builder;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class TimeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $times = Time::with([
            'cores',
            'estadio',
        ])->get();
        return $response->json($times);
    }

    public function create(Request $request, Response $response)
    {
        $form = TimeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $time = Time::create($request->getFormJSON());
        if ($request->getFormJSON()['cores']) {
            $time->cores()->sync($request->getFormJSON()['cores']);
        }

        return $response->json($time->load([
            'cores',
            'estadio',
        ]));
    }

    public function update(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        $form = TimeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $time->update($request->getFormJSON());
        if ($request->getFormJSON()['cores']) {
            $time->cores()->sync($request->getFormJSON()['cores']);
        }

        return $response->json($time->load([
            'cores',
            'estadio',
        ]));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $time = Time::with([
            'cores',
            'estadio',
            'presidente',
        ])->where('id', $id)->firstOrFail($id);

        return $response->json($time);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        $time->delete();
        return $response->noContent();
    }

    public function getEstadio(Request $request, Response $response, int $timeId)
    {
        $estadio = Estadio::where('time_id', $timeId)->first();

        return $response->json($estadio);
    }

    public function getPresidente(Request $request, Response $response, int $timeId)
    {
        $presidente = Presidente::where('time_id', $timeId)->first();

        return $response->json($presidente);
    }

    public function getUniforme(Request $request, Response $response, int $timeId)
    {
        $uniforme = Uniforme::where('time_id', $timeId)->first();

        return $response->json($uniforme);
    }

    public function getCores(Request $request, Response $response, int $timeId)
    {
        $cores = Cor::whereDoesntHave('times', function (Builder $query) use ($timeId) {
            $query->where('time_id', $timeId);
        })->get();

        $coresSelected = Cor::whereHas('times', function (Builder $query) use ($timeId) {
            $query->where('time_id', $timeId);
        })->get();

        return $response->json([
            'cores' => $cores,
            'coresSelected' => $coresSelected,
        ]);
    }

    public function saveCores(Request $request, Response $response, int $timeId)
    {
        $time = Time::findOrFail($timeId);

        if ($request->getFormJSON()['cores']) {
            $time->cores()->sync($request->getFormJSON()['cores']);
        }

        return $response->json($time->load([
            'cores',
        ]));
    }
}
