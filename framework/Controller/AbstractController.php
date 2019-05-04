<?php

namespace Framework\Controller;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Templating\View;
use Framework\Helpers\UrlsHelper;
use Framework\Configuration\Store;
use Framework\Http\RedirectResponse;
use Framework\Session\SessionManager;

abstract class AbstractController
{

    /**
     * @var string $layout
     */
    protected $layout = null;

    public function render($view, $params = [], int $statusCode = 200): Response
    {
        $view = new View($view, $this->layout, $params);

        $response = new Response();
        $response->setStatusCode($statusCode)
                 ->setContent($view->generate());

        return $response;
    }

    public function redirect($path, $statusCode = 200)
    {
        return new RedirectResponse($path, $statusCode);
    }

    public function redirectTo($routeName, $statusCode = 200)
    {
        return $this->redirect(UrlsHelper::route($routeName), $statusCode);
    }

    public function getDatabase()
    {
        return Store::getInstance()->getDatabase();
    }

    public function getRequest(): Request
    {
        return Store::getInstance()->get('Request');
    }

    /**
     * Permet de récuperer un tableau de la configuration
     * 
     * @var string $item
     */
    public function config($item)
    {
        $item = 'get' . ucfirst($item);

        return Store::getInstance()->get('Config')->$item();
    }

    public function session()
    {
        return new SessionManager();
    }

}