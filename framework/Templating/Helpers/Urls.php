<?php

use Framework\Http\Router\Exception\RouteNotFoundException;

class Urls
{

    static function route(string $routeName, $parameters = false): string
    {
        global $router;

        if(!$route = $router->find($routeName)) {
            throw new RouteNotFoundException;
        }

        $path = $route->getPath();

        if($parameters) {
            $path = $route->generate(($parameters));
        }

        return trim(SITE_URL . $path, '/');
    }


}