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
        $times = Time::all();
        return $response->json($times);
    }

    public function create(Request $request, Response $response)
    {
        $form = TimeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $time = Time::create($request->getFormJSON());

        return $response->json($time);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        $form = TimeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $time->update($request->getFormJSON());

        return $response->json($time);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        return $response->json($time);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $time = Time::findOrFail($id);
        $time->delete();
        return $response->noContent();
    }
}
