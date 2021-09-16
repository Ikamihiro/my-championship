<?php

namespace App\Controllers\Api;

use App\Forms\Cor\CorForm;
use App\Models\Cor;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class CorController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $cores = Cor::all();
        return $response->json($cores);
    }

    public function create(Request $request, Response $response)
    {
        $form = CorForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $cor = Cor::create($request->getFormJSON());

        return $response->json($cor);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $cor = Cor::findOrFail($id);
        $form = CorForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $cor->update($request->getFormJSON());

        return $response->json($cor);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $cor = Cor::findOrFail($id);
        return $response->json($cor);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $cor = Cor::findOrFail($id);
        $cor->delete();
        return $response->noContent();
    }
}
