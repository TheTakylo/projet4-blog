<?php

namespace Framework\Templating\Helpers;

use Framework\Http\Router\Exception\RouteNotFoundException;

class UrlsHelper
{

    static function route(string $routeName): string
    {
        global $router;

        if(!$route = $router->find($routeName)) {
            throw new RouteNotFoundException;
        }

        return trim(SITE_URL . $route->getPath(), '/');
    }


}