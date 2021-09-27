<?php

namespace App\Controllers\Api;

use App\Forms\ComissaoTecnica\ComissaoTecnicaForm;
use App\Models\ComissaoTecnica;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class ComissaoTecnicaController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $comissoes = ComissaoTecnica::all();
        return $response->json($comissoes);
    }

    public function create(Request $request, Response $response)
    {
        $form = ComissaoTecnicaForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $comissao = ComissaoTecnica::create($request->getFormJSON());

        return $response->json($comissao);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $comissao = ComissaoTecnica::findOrFail($id);
        $form = ComissaoTecnicaForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $comissao->update($request->getFormJSON());

        return $response->json($comissao);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $comissao = ComissaoTecnica::findOrFail($id);
        return $response->json($comissao);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $comissao = ComissaoTecnica::findOrFail($id);
        $comissao->delete();
        return $response->noContent();
    }
}
