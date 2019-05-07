<?php
use Framework\Session\FlashManager;

class Flash
{

    static function get($type)
    {
        return (new FlashManager())->get($type);
    }

    static function all()
    {
        return (new FlashManager())->all();
    }

}
