<?php

namespace Framework\Http;

class Request
{   

    private $GET;
    private $POST;
    private $SERVER;

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

        return $this->SERVER['REQUEST_METHOD'];
    }


    public function getServer()
    {
        return $this->SERVER;
    }

    public function isSecure(): bool
    {
        return (int) $this->SERVER['SERVER_PORT'] === 443;
    }

    static function all()
    {
        return new static();
    }

}