<?php

namespace Lib;

use Lib\Exceptions\AuthorizationException;
use Lib\Exceptions\IncorretPasswordException;
use Lib\Http\Controller;
use Lib\Http\Request;
use Lib\Http\Response;
use Lib\Router\Router;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public ?Controller $controller;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        try {
            $route = $this->router->getRoute();

            if (!$route) {
                echo $this->response->json([
                    'error' => 'Not found',
                ], 404);
                die();
            }

            $callback = $route->getRouteAction();

            if (is_array($callback)) {
                /**
                 * @var \Lib\Http\Controller controller
                 */
                $controller = new $callback[0];
                $controller->action = $callback[1];
                $this->controller = $controller;
                $callback[0] = $controller;
            }

            foreach ($route->getMiddlewares() as $middlewareClass) {
                /**
                 * @var \Lib\Http\Middleware\Middleware $middleware
                 */
                $middleware = new $middlewareClass();
                $middleware->execute($this->request);
            }

            echo call_user_func($callback, $this->request, $this->response, ...$this->router->getParams());
        } catch (IncorretPasswordException $th) {
            echo $this->response->json([
                'exception' => get_class($th),
                'error' => $th->getMessage(),
            ], 403);
            die();
        } catch (AuthorizationException $th) {
            echo $this->response->json([
                'exception' => get_class($th),
                'error' => $th->getMessage(),
            ], 401);
            die();
        } catch (\Throwable $th) {
            echo $this->response->json([
                'exception' => get_class($th),
                'error' => $th->getMessage(),
            ], 500);
            die();
        }
    }
}
