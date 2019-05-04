<?php

use Framework\Helpers\UrlsHelper;

class Urls
{

    static function route(string $routeName, $parameters = false): string
    {
        return UrlsHelper::route($routeName, $parameters);
    }


}