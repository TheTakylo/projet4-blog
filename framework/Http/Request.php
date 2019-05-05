<?php

namespace Framework\Http;

class Request
{   

    private $GET;
    private $POST;
    private $SERVER;

    const ALLOWED_METHOD = ['POST', 'GET', 'PUT', 'DELETE'];

    public function __construct()
    {
        $this->GET = $_GET;
        $this->POST = $_POST;
        $this->SERVER = $_SERVER;
    }

    public function getPath()
    {
        return '/' . ($this->GET['url'] ?? '');
    }

    public function getMethod()
    {
        if(!isset($this->SERVER['REQUEST_METHOD'])) {
            throw new \Exception('No request method found');
        }

        if($this->hasData()) {
           $data = $this->getData();
            if(isset($data['_method']) && in_array($data['_method'], Request::ALLOWED_METHOD)) {
                return $data['_method'];
            }
        }

        return $this->SERVER['REQUEST_METHOD'];
    }

    public function getData(): array
    {
        return $this->POST;
    }

    public function hasData(): bool
    {
        return isset($this->POST);
    }

    public function getServer()
    {
        return $this->SERVER;
    }

    public function isSecure(): bool
    {
        return (bool) $this->SERVER['SERVER_PORT'] === 443;
    }

    static function all()
    {
        return new static();
    }

}