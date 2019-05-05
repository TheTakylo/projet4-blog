<?php

namespace Framework\Session;

class FlashManager
{
    
    public function add(string $type, string $message)
    {
        if(!$this->has("FLASH_{$type}")) {
            $_SESSION["FLASH_{$type}"] = [];
        }
        
        array_push($_SESSION["FLASH_{$type}"], $message);
    }
    
    public function has(string $type): bool
    {
        return isset($_SESSION["FLASH_{$type}"]);
    }
    
    public function get(string $type): array
    {
        $flashes =  $_SESSION["FLASH_{$type}"];

        $_SESSION["FLASH_{$type}"] = [];

        return $flashes;
    }
    
}
