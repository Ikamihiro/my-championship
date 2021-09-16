<?php

namespace App\Controllers\Api;

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
        // $form = UniformeForm::make($request->getFormJSON());

        // if (!$form->validate()) {
        //     return $response->badRequest($form->getErrors());
        // }

        // $uniforme = Uniforme::create($request->getFormJSON());
        // return $response->json($uniforme);
    }

    public function update(Request $request, Response $response, int $id)
    {
        // $uniforme = Uniforme::findOrFail($id);
        // $form = UniformeForm::make($request->getFormJSON());

        // if (!$form->validate()) {
        //     return $response->badRequest($form->getErrors());
        // }

        // $uniforme->update($request->getFormJSON());
        // return $response->json($uniforme);
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
