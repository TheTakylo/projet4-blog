<?php

namespace Framework\Configuration;

use Framework\Router\Router;

class Store
{
    private $store = [];
    
    private static $_instance;
    
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Store();
        }
        return self::$_instance;
    }
    
    private function __construct() { }
    
    public function get($key)
    {
        if (!isset($this->store[$key])) {
            return null;
        }
        return $this->store[$key];
    }
    
    public function set($key,  $value)
    {
        $this->store[$key] = $value;
    }

    public function getRouter(): Router
    {
        return $this->get('Router');
    }

    public function getDatabase()
    {
        return $this->get('Database');
    }
    
}