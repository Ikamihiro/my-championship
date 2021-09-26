<?php

namespace App\Controllers\Api;

use App\Forms\Time\TimeForm;
use App\Models\Time;
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
        $time = Time::with('cores')->where('id', $id)->firstOrFail($id);
        return $response->json($time);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        $time->delete();
        return $response->noContent();
    }
}
