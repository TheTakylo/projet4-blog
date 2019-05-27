<?php

namespace Framework\Http\DataRequest;


class ServerRequest extends AbstractDataRequest
{

    public function isSecure(): bool
    {
        return (bool)($this->get('SERVER_PORT') === 443 || ($this->has('HTTPS') && $this->get('HTTPS') !== 'off'));
    }

}