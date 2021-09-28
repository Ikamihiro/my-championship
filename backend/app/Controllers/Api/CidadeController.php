<?php

namespace App\Controllers\Api;

use App\Forms\Cidade\CidadeForm;
use App\Models\Cidade;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class CidadeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $cidades = Cidade::with('estado')->get();
        return $response->json($cidades);
    }

    public function create(Request $request, Response $response)
    {
        $form = CidadeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $cidade = Cidade::create($request->getFormJSON());

        return $response->json($cidade);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $cidade = Cidade::findOrFail($id);
        $form = CidadeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $cidade->update($request->getFormJSON());

        return $response->json($cidade);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $cidade = Cidade::findOrFail($id);
        return $response->json($cidade);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $cidade = Cidade::findOrFail($id);
        $cidade->delete();
        return $response->noContent();
    }
}
