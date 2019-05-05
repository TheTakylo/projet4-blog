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

    public function __construct(array $routes, Request $request)
    {
        $this->request = $request;

        $this->setRoutes($routes);
    }
    
    /**
     * setRoutes
     *
     * @param  Route[] $routes
     *
     * @return void
     */
    private function setRoutes(array $routes)
    {
        foreach($routes as $route) {
            array_push($this->routes, new Route($route[0], $route[1], $route[2] ?? [] ));
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
        $requestMethod = $this->request->getMethod();
        
        foreach($this->routes as $route) {
            if(in_array($requestMethod, $route->getMethods()) && $route->match($this->request->getPath())) {
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
