<?php

namespace Framework\Session;

class SessionManager
{

    public function has($item): bool
    {
        return isset($_SESSION[$item]);
    }

    public function set($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function clear()
    {
        session_destroy();
    }

}
