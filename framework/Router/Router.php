<?php

namespace Framework\Router;

use Framework\Http\Request;
use Framework\Router\Exception\RouteNotFoundException;

class Router
{
    
    /** @var Route[] $routes */
    private $routes = [];
    
    /** @var Request $request */
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
            if(is_array($route[1])) {
                foreach($route[1] as $prefixedRoutes) {
                    array_push($this->routes, new Route($prefixedRoutes[0], $prefixedRoutes[1], $prefixedRoutes[2] ?? [], $route[0]));
                }
            } else {
                array_push($this->routes, new Route($route[0], $route[1], $route[2] ?? []));
            }
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

        throw new RouteNotFoundException();
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
        $path = 'http' . ($this->request->server->isSecure() ? 's' : '');
        $path .= '://' . $this->request->server->get('SERVER_NAME');
        $path .= str_replace('index.php', '', $this->request->server->get('SCRIPT_NAME'));
        
        return trim($path, '/');
    }
    
}
