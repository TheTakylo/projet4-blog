<?php
use Framework\Session\SessionManager;

class Session
{

    static function has($item)
    {
        return (new SessionManager())->has($item);
    }

}
