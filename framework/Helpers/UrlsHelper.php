<?php

namespace Framework\Helpers;

use Framework\Configuration\Store;
use Framework\Http\Router\Exception\RouteNotFoundException;

class UrlsHelper
{

    static function route(string $routeName, $parameters = false): string
    {
        if(!$route = Store::getInstance()->getRouter()->find($routeName)) {
            throw new RouteNotFoundException;
        }

        $path = $route->getPath();

        if($parameters) {
            $path = $route->generate(($parameters));
        }

        return trim(SITE_URL . $path, '/');
    }


}