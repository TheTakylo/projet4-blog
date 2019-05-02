<?php

namespace Framework\Templating\Helpers;

use Framework\Templating\Exception\PartialNotFoundException;

class PartialsHelper
{

    public function load(string $partial)
    {
        $path = TEMPLATE . $partial;

        if(!file_exists($path)) {
            throw new PartialNotFoundException;
        }

        require $path;
    }

}