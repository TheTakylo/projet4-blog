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
    private $methods;
    
    /**
    * @var array
    */
    private $params = [];
    
    private $fullName;
    
    private $prefix;
    
    /**
    * __construct
    *
    * @param  mixed $path
    * @param  mixed $action
    *
    * @return void
    */
    public function __construct(string $path, string $action, array $methods = [], $prefix = null)
    {
        $splitted = explode('@', $action);
        
        $this->fullName = $action;
        $this->controller = $splitted[0];
        $this->action = $splitted[1];
        $this->methods = $methods;
        $this->path = $path;
        
        if($prefix) {
            $this->prefix = $prefix;
        }
        
    }
    
    /**
    *
    * @param string $path URL de la reqûete
    *
    * @return bool
    */
    public function match(string $path): bool
    {
        $path_regex = preg_replace('#:([\w]+)#', '([^/]+)', $this->getPath());
        
        if(!preg_match("#^$path_regex$#i", $path, $params)){
            return false;
        }
        
        array_shift($params);
        
        $this->params = $params;
        
        return true;
    }
    
    public function generate($parameters): string
    {
        $path = $this->path;
        
        foreach($parameters as $key => $value) {
            $path = str_replace(":{$key}", $value, $path);
        }
        
        return ($this->prefix ?? '') . $path;
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
        return ($this->prefix ?? '') . $this->path;
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
    
    /**
    * Set the value of methods
    *
    * @param  array  $methods
    *
    * @return  self
    */ 
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
        
        return $this;
    }
    
    /**
    * Get the value of methods
    *
    * @return  array
    */ 
    public function getMethods(): array
    {
        return $this->methods;
    }
    
    /**
    * Get the value of fullName
    */ 
    public function getFullName()
    {
        return $this->fullName;
    }
    
    public function prefix($group): bool {
        return $this->prefix === $group;
    }
}