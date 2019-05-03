<?php

namespace Framework\Templating;

use Framework\Templating\Helpers\AssetsHelper;
use Framework\Templating\Exception\TemplateNotFoundException;

class View
{
    
    /**
    * @var string $file
    */
    private $file;
    
    /**
    * @var string $layout
    */
    private $layout;
    
    /**
    * @var array $params
    */
    private $params;
    
    public function __construct(string $file, ?string $layout, array $params)
    {
        $this->file = $file;
        $this->layout = $layout;
        $this->params = $params;
        
    }

    private function loadHelpers() {
        require CORE . '/Templating/Helpers/Assets.php';
        require CORE . '/Templating/Helpers/Urls.php';
        require CORE . '/Templating/Helpers/Partials.php';
        require CORE . '/Templating/Helpers/Text.php';
    }
    
    /**
    * @return string
    */
    public function generate()
    {
        if(!file_exists(TEMPLATE . $this->file)) {
            throw new TemplateNotFoundException("Template not found");
        }

        
        extract($this->params);
        
        $this->loadHelpers();

        ob_start();
        
        require TEMPLATE . $this->file;
        
        $content = ob_get_clean();
        
        if(!$this->layout) {
            return $content;
        }
        
        if(!file_exists(TEMPLATE . 'layouts/' . $this->layout . '.php')) {
            throw new TemplateNotFoundException("Layout not found");
        }
        
        ob_start();
        
        require TEMPLATE . 'layouts/' . $this->layout . '.php';
        
        return ob_get_clean(); 
    }
    
}