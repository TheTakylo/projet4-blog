<?php

namespace Framework\Http\DataRequest;

use Framework\Http\DataRequest\AbstractDataRequest;

class ServerRequest extends AbstractDataRequest
{
 
    public function isSecure(): bool
    {
        return (bool) $this->get('SERVER_PORT') === 443;
    }

}