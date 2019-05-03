<?php

namespace Framework\Router;

use Framework\Http\Request;
use Framework\Router\Route;

class Router
{

    /**
     * @var Route[]
     */
    private $routes = [];

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * setRoutes
     *
     * @param  Route[] $routes
     *
     * @return void
     */
    public function setRoutes(array $routes)
    {
        foreach($routes as $route) {
            array_push($this->routes, new Route($route[0], $route[1]));
        }
    }

    /**
     * match
     *
     * @param  Request $request
     *
     * @return Route
     */
    public function match(): ?Route
    {
        foreach($this->routes as $route) {
            if($route->match($this->request->getPath())) {
                return $route;
            }
        }

        return null;
    }

    public function find(string $action): ?Route
    {
        foreach($this->routes as $route) {
            $routeAction = $route->getController() . '@' . $route->getAction();

            if($action === $routeAction) {
                return $route;
            }
        }

        return null;
    }

    public function getRoot(): string
    {
        $server = $this->request->getServer();

        $path = 'http' . ($this->request->isSecure() ? 's' : '');
        $path .= '://' . $server['SERVER_NAME'];
        $path .= str_replace('index.php', '', $server['SCRIPT_NAME']);

        return trim($path, '/');
    }



}
