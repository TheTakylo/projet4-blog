<?php

namespace App\Controller;

use Framework\Templating\Helpers\Urls;
use Framework\Http\Response;
use Framework\Http\RedirectResponse;
use Framework\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index(): Response
    {
        return new RedirectResponse(Urls::route('security@login'));
    }

}