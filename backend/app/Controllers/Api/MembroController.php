<?php

namespace App\Controllers\Api;

use App\Forms\Membro\MembroForm;
use App\Models\Membro;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class MembroController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json(Membro::all());
    }

    public function create(Request $request, Response $response)
    {
        $form = MembroForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $membro = Membro::create($request->getFormJSON());
        return $response->json($membro);
    }

    public function update(Request $request, Response $response, int $id)
    {
        $membro = Membro::findOrFail($id);
        $form = MembroForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $membro->update($request->getFormJSON());
        return $response->json($membro);
    }

    public function show(Request $request, Response $response, int $id)
    {
        return $response->json(Membro::findOrFail($id));
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $membro = Membro::findOrFail($id);
        $membro->delete();
        return $response->noContent();
    }
}
