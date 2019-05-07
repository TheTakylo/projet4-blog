<?php

namespace Framework\Http\DataRequest;

class AbstractDataRequest
{

    private $property;

    public function __construct(array $property)
    {
        $this->property = $property;
    }

    public function get($item = false)
    {
        if(!$item) {
            return $this->property;
        }

        if($this->has($item)) {
            return $this->property[$item];
        }

        return null;
    }

    public function has($item): bool
    {
        return isset($this->property[$item]);
    }

}