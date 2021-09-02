<?php

namespace Lib\Router;

class Route
{
    /**
     * @var string $routeMethod
     */
    protected string $routeMethod;

    /**
     * @var array $routeName
     */
    protected string $routeName;

    /**
     * @var array|callable $routeAction
     */
    protected $routeAction;

    /**
     * @var array $middlewares
     */
    protected array $middlewares;

    /**
     * @param string $routeMethod
     * @param string $routeName
     * @param array|callable $routeAction
     * @param array $middlewares
     */
    public function __construct(string $routeMethod, string $routeName, $routeAction)
    {
        $this->routeMethod = $routeMethod;
        $this->routeName = $routeName;
        $this->routeAction = $routeAction;
        $this->middlewares = [];
        $this->afterMiddlewares = [];
    }

    /**
     * @return string
     */
    public function getRouteMethod()
    {
        return $this->routeMethod;
    }

    /**
     * @return string
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * @return array|callable
     */
    public function getRouteAction()
    {
        return $this->routeAction;
    }

    /**
     * @return array
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
    
    /**
     * @param string $middleware
     *
     * @return Route
     */
    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }
}
