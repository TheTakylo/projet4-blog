<?php

namespace Framework\Session;

class FlashManager
{
    
    public function add(string $type, string $message)
    {
        if(!$this->has($type)) {
            $_SESSION["FLASH"][$type] = [];
        }
        
        array_push($_SESSION["FLASH"][$type], $message);
    }
    
    public function has(string $type): bool
    {
        return isset($_SESSION["FLASH"][$type]);
    }
    
    public function get(string $type): array
    {
        $flashes =  $_SESSION["FLASH"][$type] ?? [];

        $_SESSION["FLASH"][$type] = [];

        return $flashes;
    }

    public function all(): ?array
    {
        $flashes =  $_SESSION["FLASH"] ?? [];

        $_SESSION["FLASH"] = [];

        return $flashes;
    }
    
}
