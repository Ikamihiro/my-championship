<?php

namespace App\Controllers\Api;

use App\Forms\Uniforme\UniformeForm;
use App\Models\Uniforme;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class UniformeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $uniformes = Uniforme::all();
        return $response->json($uniformes);
    }

    public function create(Request $request, Response $response)
    {
        $form = UniformeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $uniforme = Uniforme::create($request->getFormJSON());
        return $response->json($uniforme);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $uniforme = Uniforme::findOrFail($id);
        $form = UniformeForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $uniforme->update($request->getFormJSON());
        return $response->json($uniforme);
    }

    public function show(Request $request, Response $response, int $id)
    {
        $uniforme = Uniforme::findOrFail($id);
        return $response->json($uniforme);
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $uniforme = Uniforme::findOrFail($id);
        $uniforme->delete();
        return $response->noContent();
    }
}
