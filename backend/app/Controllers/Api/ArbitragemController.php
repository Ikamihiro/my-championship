<?php

namespace App\Controllers\Api;

use App\Forms\Arbitragem\ArbitragemForm;
use App\Models\Arbitragem;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class ArbitragemController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $arbitragens = Arbitragem::all();
        return $response->json($arbitragens);
    }

    public function create(Request $request, Response $response)
    {
        $form = ArbitragemForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $arbitragem = Arbitragem::create($request->getFormJSON());

        return $response->json($arbitragem);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $arbitragem = Arbitragem::findOrFail($id);
        $form = ArbitragemForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $arbitragem->update($request->getFormJSON());

        return $response->json($arbitragem);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $arbitragem = Arbitragem::findOrFail($id);
        return $response->json($arbitragem);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $arbitragem = Arbitragem::findOrFail($id);
        $arbitragem->delete();
        return $response->noContent();
    }
}
