<?php

namespace App\Controllers\Api;

use App\Forms\Auth\LoginForm;
use App\Forms\Auth\RegisterForm;
use App\Models\User;
use Lib\Auth\Auth;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request, Response $response)
    {
        $form = RegisterForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $user = User::create(array_merge($request->getFormJSON(), [
            'password' => password_hash($request->getFormJSON()['password'], PASSWORD_BCRYPT),
        ]));

        return $response->json($user);
    }

    public function login(Request $request, Response $response)
    {
        $form = LoginForm::make($request->getFormJSON());

        if (!$form->validate()) {
            return $response->badRequest($form->getErrors());
        }

        $jwtToken = Auth::authenticate(
            $request->getFormJSON()['email'],
            $request->getFormJSON()['password'],
        );

        return $response->json([
            'token' => $jwtToken,
        ]);
    }
}
