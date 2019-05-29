<?php

namespace Framework;

use Framework\Configuration\ConfigurationParser;
use Framework\Configuration\Store;
use Framework\Database\Database;
use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router\Exception\RouteNotFoundException;
use Framework\Router\Router;

class Kernel
{

    /** @var string $env */
    private $env;

    /** @var ConfigurationParser */
    private $config;

    public function __construct($app, ConfigurationParser $config)
    {
        $this->env = $app['environement'];
        $this->config = $config;
    }

    public function getResponse()
    {
        $this->initializeEnvironement();


        $store = Store::getInstance();
        $store->set('Config', $this->config);
        $store->set('Database', (new Database($this->config->getDatabase()))->getConnection());
        $store->set('Request', Request::all());
        $store->set('Router', new Router($this->config->getRoutes(), $store->get('Request')));

        define('SITE_URL', $store->getRouter()->getRoot());


        try {
            if ($route = $store->getRouter()->match()) {

                $controller = 'App\\Controller\\' . ucfirst($route->getController()) . 'Controller';
                $controller = new $controller;

                /** @var Response $response */
                $response = call_user_func_array([$controller, $route->getAction()], $route->getParams());

                return $response->send();
            }
        } catch (RouteNotFoundException $e) {
        }
    }

    private function initializeEnvironement()
    {
        session_start();

        if ($this->env === 'prod') {
            ini_set("display_errors", "off");
            error_reporting(0);
        } else if($this->env === 'dev'){
            ini_set("display_errors", "on");
            error_reporting(-1);
        }
    }

}