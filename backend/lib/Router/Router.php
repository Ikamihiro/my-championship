<?php

namespace Lib\Router;

use Lib\Http\Request;

class Router
{
    /**
     * @var Route[] $routes
     */
    private array $routes;

    /**
     * @var Request $request
     */
    public Request $request;

    /**
     * @var array $params
     */
    private array $params;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->routes = [];
        $this->params = [];
    }

    /**
     * @param string $method
     * @param string $route
     * @param string|callable $action
     *
     * @return Router
     */
    public function add(string $method, string $route, $action)
    {
        $newRoute = new Route($method, $route, $action);

        $this->routes[$method][$route] = $newRoute;

        return $this->routes[$method][$route];
    }

    /**
     * @param string $route
     * @param string|callable $action
     *
     * @return Route
     */
    public function get(string $route, $action)
    {
        return $this->add('get', $route, $action);
    }

    /**
     * @param string $route
     * @param string|callable $action
     *
     * @return Route
     */
    public function post(string $route, $action)
    {
        return $this->add('post', $route, $action);
    }

    /**
     * @param string $route
     * @param string|callable $action
     *
     * @return Route
     */
    public function put(string $route, $action)
    {
        return $this->add('put', $route, $action);
    }

    /**
     * @param string $route
     * @param string|callable $action
     *
     * @return Route
     */
    public function delete(string $route, $action)
    {
        return $this->add('delete', $route, $action);
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params ? array_slice($this->params, 1) : [];
    }

    /**
     * Method getRoute
     *
     * @return Route|bool
     */
    public function getRoute()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();

        if (isset($this->routes[$method][$url])) {
            return $this->routes[$method][$url];
        }

        /**
         * @var Route $route
         */
        foreach ($this->routes[$method] as $route) {
            $result = $this->checkUrl($route->getRouteName(), $url);

            if ($result >= 1) {
                return $route;
            }
        }

        return false;
    }

    private function checkUrl(string $route, $path)
    {
        preg_match_all('/\{([^\}]*)\}/', $route, $variables);
        $regex = str_replace('/', '\/', $route);

        foreach ($variables[0] as $k => $variable) {
            $replacement = '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variable, $replacement, $regex);
        }

        $result = preg_match('/^' . $regex . '$/', $path, $params);
        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);

        $this->params = $params;

        return $result;
    }

    public function apiRoutes(string $prefix, string $controllerClass, string $middlewareClass = null)
    {
        $index = $this->get($prefix, [$controllerClass, 'index']);
        $create = $this->post($prefix, [$controllerClass, 'create']);
        $update = $this->put($prefix . '/{id}', [$controllerClass, 'update']);
        $show = $this->get($prefix . '/{id}', [$controllerClass, 'show']);
        $delete = $this->delete($prefix . '/{id}', [$controllerClass, 'delete']);

        if (!is_null($middlewareClass)) {
            $index->addMiddleware($middlewareClass);
            $create->addMiddleware($middlewareClass);
            $update->addMiddleware($middlewareClass);
            $show->addMiddleware($middlewareClass);
            $delete->addMiddleware($middlewareClass);
        }

        return $this;
    }
}
