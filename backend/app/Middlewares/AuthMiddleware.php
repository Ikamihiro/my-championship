<?php

namespace App\Middlewares;

use Exception;
use Lib\Auth\Auth;
use Lib\Exceptions\AuthorizationException;
use Lib\Http\Middleware\Middleware;
use Lib\Http\Request;

class AuthMiddleware extends Middleware
{
    public function execute(Request $request)
    {
        $authorizationHeader = $request->getHeader("Authorization");

        if (is_null($authorizationHeader)) {
            throw new AuthorizationException("Request has no authorization header!");
        }

        try {
            Auth::validate($authorizationHeader);
        } catch (\Throwable $th) {
            throw new AuthorizationException($th->getMessage());
        }
    }
}
