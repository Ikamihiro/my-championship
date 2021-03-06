<?php

namespace App\Controllers\Api;

use App\Forms\Presidente\PresidenteForm;
use App\Models\Presidente;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class PresidenteController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json(Presidente::all());
    }

    public function create(Request $request, Response $response)
    {
        $form = PresidenteForm::make($request->getFormJSON());
        if (!$form->validate()) return $response->badRequest($form->getErrors());

        $presidente = Presidente::create($request->getFormJSON());

        return $response->json($presidente);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $presidente = Presidente::findOrFail($id);
        $form = PresidenteForm::make($request->getFormJSON());

        if (!$form->validate()) return $response->badRequest($form->getErrors());

        $presidente->update($request->getFormJSON());
        return $response->json($presidente);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $presidente = Presidente::findOrFail($id);
        return $response->json($presidente);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $presidente = Presidente::findOrFail($id);
        $presidente->delete();
        return $response->noContent();
    }
}
