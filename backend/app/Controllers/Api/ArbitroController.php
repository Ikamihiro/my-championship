<?php

namespace App\Controllers\Api;

use App\Forms\Arbitro\ArbitroForm;
use App\Models\Arbitro;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class ArbitroController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $arbitros = Arbitro::all();
        return $response->json($arbitros);
    }

    public function create(Request $request, Response $response)
    {
        $form = ArbitroForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $arbitro = Arbitro::create($request->getFormJSON());

        return $response->json($arbitro);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $arbitro = Arbitro::findOrFail($id);
        $form = ArbitroForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $arbitro->update($request->getFormJSON());

        return $response->json($arbitro);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $arbitro = Arbitro::findOrFail($id);
        return $response->json($arbitro);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $arbitro = Arbitro::findOrFail($id);
        $arbitro->delete();
        return $response->noContent();
    }
}
