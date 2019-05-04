<?php

namespace Framework\Controller;

use Framework\Http\Response;
use Framework\Templating\View;
use Framework\Helpers\UrlsHelper;
use Framework\Http\RedirectResponse;

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

    public function redirectTo($routeName, $statusCode = 200)
    {
        return $this->redirect(UrlsHelper::route($routeName), $statusCode);
    }

}