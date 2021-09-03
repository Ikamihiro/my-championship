<?php

namespace App\Controllers;

use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;

class HomeController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->json([
            'data' => 'Hello World!',
        ]);
    }

    public function hello(Request $request, Response $response, string $name)
    {
        return $response->json([
            'data' => "Hello, $name!",
        ]);
    }
}
