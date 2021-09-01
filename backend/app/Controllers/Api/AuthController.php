<?php

namespace App\Controllers\Api;

use App\Forms\User\CreateUserForm;
use App\Forms\User\UpdateUserForm;
use App\Models\User;
use Frankenstein\Http\Controller;
use Frankenstein\Http\Request;
use Frankenstein\Http\Response;

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
