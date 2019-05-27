<?php

use Framework\Templating\Exception\PartialNotFoundException;

class Partials
{

    static function load(string $partial)
    {
        $path = TEMPLATE . $partial;

        if(!file_exists($path)) {
            throw new PartialNotFoundException;
        }

        require $path;
    }

}