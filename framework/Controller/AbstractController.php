<?php

namespace Framework\Controller;

use Framework\Http\Request;
use Framework\Http\Response;
use Framework\Templating\View;
use Framework\Helpers\UrlsHelper;
use Framework\Configuration\Store;
use Framework\Session\FlashManager;
use Framework\Http\RedirectResponse;
use Framework\Session\SessionManager;
use Framework\Database\Repository\AbstractRepository;

abstract class AbstractController
{

    /**
     * @var string $layout
     */
    protected $layout = null;

    /** @var Request $request */
    protected $request;

    public function __construct()
    {
        $this->request = Store::getInstance()->get('Request');
    }

    public function render($view, $params = [], int $statusCode = 200): Response
    {
        $view = new View($view, $this->layout, $params);

        $response = new Response();
        $response->setStatusCode($statusCode)
                 ->setContent($view->generate());

        return $response;
    }

    public function redirect($path, $statusCode = 200): RedirectResponse
    {
        return (new RedirectResponse($path, $statusCode));
    }

    public function redirectTo($routeName, $routeParameters = [], $statusCode = 200): RedirectResponse
    {
        return $this->redirect(UrlsHelper::route($routeName, $routeParameters), $statusCode);
    }

    public function referer(): RedirectResponse
    {
        return $this->redirect($this->request->getReferer());
    }

    public function getDatabase(): \PDO
    {
        return Store::getInstance()->getDatabase();
    }

    public function getRequest(): Request
    {
        return Store::getInstance()->get('Request');
    }

    public function config($item)
    {
        $item = 'get' . ucfirst($item);

        return Store::getInstance()->get('Config')->$item();
    }

    public function session(): SessionManager
    {
        return new SessionManager();
    }

    public function flash(): FlashManager
    {
        return new FlashManager();
    }

    public function getRepository($repository): AbstractRepository
    {
        return new $repository();
    }

}