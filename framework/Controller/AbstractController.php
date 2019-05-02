<?php

namespace Framework\Controller;

use Framework\Http\Response;
use Framework\Templating\View;
use Framework\Http\RedirectResponse;
use Framework\Http\Router\Exception\RouteNotFoundException;

abstract class AbstractController
{

    /**
     * @var string;
     */
    protected $layout = null;

    public function render($view, $params = []): Response
    {
        $view = new View($view, $this->layout, $params);

        $response = new Response();
        $response->setContent($view->generate());

        return $response;
    }

    public function redirect($path, $statusCode = 200)
    {
        return new RedirectResponse($path, $statusCode);
    }

    public function redirectTo($route, $statusCode = 200)
    {
        global $router;
        
        if(!$route = $router->find($route)) {
            throw new RouteNotFoundException;
        }

        return $this->redirect($route->getPath(), $statusCode);
    }

}