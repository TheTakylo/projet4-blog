<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class SecurityController extends AbstractController
{

    public function login(): Response
    {
        return (new Response)->setContent(("Login"));
    }

}