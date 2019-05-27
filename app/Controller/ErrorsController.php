<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class ErrorsController extends AbstractController
{

    protected $layout = 'base_layout';

    public function notFound(): Response
    {
        return $this->render('_errors/404.php', [], 404);
    }

}