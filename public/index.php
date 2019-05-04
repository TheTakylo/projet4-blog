<?php
ini_set("display_errors", "on");

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__));
define('CORE', ROOT . DS . 'framework');
define('TEMPLATE', ROOT . DS . 'app' . DS . 'View' . DS);

require '../vendor/autoload.php';

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Router\Router;
use Framework\Database\Database;
use Framework\Configuration\Store;
use Framework\Configuration\ConfigurationParser;

$config = new ConfigurationParser(ROOT . DS . 'config.php');
$store = Store::getInstance();

$store->set('Database', (new Database($config->getDatabase()))->getConnection());
$store->set('Request', Request::all());
$store->set('Router', new Router($config->getRoutes(), $store->get('Request')));

define('SITE_URL', $store->getRouter()->getRoot());

if($route = $store->getRouter()->match()) {
    
    $controller = 'App\\Controller\\' . ucfirst($route->getController()) . 'Controller';
    $controller = new $controller;

    $response = call_user_func_array([$controller, $route->getAction()], $route->getParams());

    if(!$response instanceof Response) {
        return;
    }

    return $response->send();

} else {
    var_dump($route);
    die('Not found');
}
