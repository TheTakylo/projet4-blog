<?php

namespace Framework\Router;

class Route
{
    
    /**
    * @var string
    */
    private $controller;
    
    /**
    * @var string
    */
    private $action;
    
    /**
    * @var string
    */
    private $path;

    /**
     * @var array
     */
    private $params = [];
    
    /**
    * __construct
    *
    * @param  mixed $path
    * @param  mixed $action
    *
    * @return void
    */
    public function __construct(string $path, string $action)
    {
        $splitted = explode('@', $action);
        
        $this->controller = $splitted[0];
        $this->action = $splitted[1];
        
        $this->path = $path;
    }
    
    /**
    * match
    *
    * @param  mixed $path
    *
    * @return bool
    */
    public function match(string $path): bool
    {
        $path_regex = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);

        if(!preg_match("#^$path_regex$#i", $path, $params)){
            return false;
        }
        
        array_shift($params);

        $this->params = $params;

        return true;
    }
    
    /**
    * Get the value of action
    */
    public function getAction(): string
    {
        return $this->action;
    }
    
    /**
    * Get the value of controller
    */
    public function getController(): string
    {
        return $this->controller;
    }
    
    /**
    * Get the value of path
    */
    public function getPath(): string
    {
        return $this->path;
    }
    

    /**
     * Get the value of params
     *
     * @return  array
     */ 
    public function getParams(): array
    {
        return $this->params;
    }
}