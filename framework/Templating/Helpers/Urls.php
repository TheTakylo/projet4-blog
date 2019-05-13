<?php

use Framework\Helpers\UrlsHelper;
use Framework\Configuration\Store;

class Urls
{

    static function route(string $routeName, $parameters = false): string
    {
        return UrlsHelper::route($routeName, $parameters);
    }

    static function match($routeName): bool
    {
        if(!$route = Store::getInstance()->getRouter()->match()->getFullName() === $routeName) {
            return false;
        }
        
        return true;
    }

    static function prefix($group): bool
    {
        return Store::getInstance()->getRouter()->match()->prefix($group);
    }

}