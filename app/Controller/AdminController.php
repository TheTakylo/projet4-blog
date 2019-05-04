<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class AdminController extends AbstractController
{

    public function index(): Response
    {
        return $this->redirectTo('security@login');
    }

}