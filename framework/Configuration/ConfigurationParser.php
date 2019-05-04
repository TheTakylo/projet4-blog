<?php

namespace Framework\Configuration;

use Framework\Configuration\Exception\ConfigurationNotFound;


class ConfigurationParser
{

    private $config;

    public function __construct($filePath)
    {
        if(!file_exists($filePath)) {
            throw new ConfigurationNotFound();
        }

        $this->config = require $filePath;
    }

    public function getDatabase(): array
    {
        return $this->getConfigurationItem('Database');
    }

    public function getRoutes(): array
    {
        return $this->getConfigurationItem('Routes');
    }
    
    private function getConfigurationItem($key)
    {
        if(!array_key_exists($key, $this->config)) {
            return;
        }
        
        return $this->config[$key];
    }
    
    public function __call($name, $args)
    {
        $name = str_replace('get', '', $name);

       return $this->getConfigurationItem($name);
    }
    
}