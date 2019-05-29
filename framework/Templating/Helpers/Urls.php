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
        if(is_array($routeName)) {
            foreach($routeName as $route => $v) {
                if(Store::getInstance()->getRouter()->match()->getFullName() !== $v) {
                    continue;
                }

                return true;
            }
        }


        if(Store::getInstance()->getRouter()->match()->getFullName() === $routeName) {
            return true;
        }
        
        return false;
    }

    static function prefix($group): bool
    {
        return Store::getInstance()->getRouter()->match()->prefix($group);
    }

}