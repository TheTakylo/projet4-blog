<?php

namespace Framework\Http;

class Response
{
    
    private $headers = [];

    /**
    * @var int
    */
    private $statusCode = 200;
    
    /**
    * @var string
    */
    private $contentType = 'text/html';
    
    /**
    * @var string;
    */
    private $content;
    

    /**
     * @var string
     */
    public function redirect($path)
    {
        $this->addHeader('Location: ' . $path);

        return $this->sendHeaders();
    }
    
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        
        return $this;
    }
    
    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;
        
        return $this;
    }
    
    
    public function setContent(string $content): self
    {
        $this->content = $content;
        
        return $this;
    }
    
    public function getContentType()
    {
        return $this->contentType;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function getContent()
    {
        return $this->content;
    }
    
    private function addHeader($header)
    {
        array_push($this->headers, $header);
        
        return $this;
    }
    
    private function sendHeaders()
    {
        foreach($this->headers as $header) {
            header($header);
        }
    }

    public function send()
    {
        http_response_code($this->getStatusCode());
        $this->sendHeaders();

        echo $this->getContent();
    }

}