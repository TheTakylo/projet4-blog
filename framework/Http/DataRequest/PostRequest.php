<?php

namespace Framework\Http\DataRequest;

use Framework\Http\DataRequest\AbstractDataRequest;

class PostRequest extends AbstractDataRequest
{
    public function get($item = false, $secure = true)
    {
        if(!$item) {
            return parent::get();
        }

        if(!$secure) {
            return parent::get($item);
        }

        return trim(htmlspecialchars(strip_tags(parent::get($item))));
    }
}