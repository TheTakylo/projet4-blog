<?php

namespace Framework\Http;

use Framework\Http\Response;

class RedirectResponse extends Response
{

    public function __construct(string $path, int $statusCode = 200)
    {
        return $this
                ->setStatusCode($statusCode)
                ->redirect($path)
                ->send();
    }

}