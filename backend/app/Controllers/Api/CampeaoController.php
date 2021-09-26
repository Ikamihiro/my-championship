<?php

namespace App\Controllers\Api;

use App\Forms\Campeao\CampeaoForm;
use App\Models\Campeao;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class CampeaoController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $campeoes = Campeao::with([
            'time',
            'campeonato',
        ])->orderBy('created_at', 'desc')->get();

        return $response->json($campeoes);
    }

    public function create(Request $request, Response $response)
    {
        $form = CampeaoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $campeao = Campeao::create($request->getFormJSON());

        return $response->json($campeao->load([
            'time',
            'campeonato',
        ]));
    }

    public function update(Request $request, Response $response, int $id)
    {
        $campeao = Campeao::findOrfail($id);
        $form = CampeaoForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $campeao->update($request->getFormJSON());

        return $response->json($campeao->load([
            'time',
            'campeonato',
        ]));
    }

    public function show(Request $request, Response $response, int $id)
    {
        $campeao = Campeao::with([
            'time',
            'campeonato',
        ])->where('id', $id)->firstOrFail();

        return $response->json($campeao);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $campeao = Campeao::findOrfail($id);
        $campeao->delete();
        return $response->noContent();
    }
}
