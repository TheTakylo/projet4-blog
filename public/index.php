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

$request = new Request();

$router = new Router($request);

define('SITE_URL', $router->getRoot());

require '../routes.php';

$database = new Database('localhost', 'root', 'root', 'projet4');

if($route = $router->match()) {
    
    $controller = 'App\\Controller\\' . ucfirst($route->getController()) . 'Controller';
    $controller = new $controller;

    $response = call_user_func_array([$controller, $route->getAction()], $route->getParams());

    if(!$response instanceof Response) {
        return;
    }



    echo $response->send();

} else {
    var_dump($route);
    die('Not found');
}
