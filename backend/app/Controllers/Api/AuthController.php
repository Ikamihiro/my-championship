<?php

namespace App\Controllers\Api;

use App\Forms\User\CreateUserForm;
use App\Models\User;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request, Response $response)
    {
        $form = CreateUserForm::create($request->getFormJSON());

        if (!$form->validate()) {
            return $response->json([
                'errors' => $form->getErrors(),
            ], 400);
        }

        $user = User::create(array_merge($request->getFormJSON(), [
            'senha' => password_hash($request->getFormJSON()['senha'], PASSWORD_BCRYPT),
        ]));

        return $response->json($user);
    }

    public function login(Request $request, Response $response)
    {
        return $response->json([
            'ok' => true,
        ]);
    }
}
