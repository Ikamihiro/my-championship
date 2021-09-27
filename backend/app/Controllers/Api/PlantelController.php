<?php

namespace App\Controllers\Api;

use App\Forms\Plantel\PlantelForm;
use App\Models\Plantel;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class PlantelController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json(Plantel::all());
    }

    public function create(Request $request, Response $response)
    {
        $form = PlantelForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $plantel = Plantel::create($request->getFormJSON());
        return $response->json($plantel);
    }

    public function update (Request $request, Response $response, int $id)
    {
        $plantel = Plantel::findOrFail($id);
        $form = PlantelForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $plantel->update($request->getFormJSON());
        return $response->json($plantel);
    }

    public function show(Request $request, Response $response, int $id)
    {
        return $response->json(Plantel::findOrFail($id));
    }

    public function delete(Request $request, Response $response, int $id)
    {
        $plantel = Plantel::findOrFail($id);
        $plantel->delete();
        return $response->noContent();
    }
    
}