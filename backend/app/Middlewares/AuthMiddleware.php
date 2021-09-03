<?php

namespace App\Middlewares;

use Exception;
use Lib\Auth\Auth;
use Lib\Http\Middleware\Middleware;
use Lib\Http\Request;

class AuthMiddleware extends Middleware
{
    public function execute(Request $request)
    {
        $authorizationHeader = $request->getHeader("Authorization");

        if (is_null($authorizationHeader)) {
            throw new Exception("Request has no authorization header!");
        }

        Auth::getInstance()->decode($authorizationHeader);
    }
}
