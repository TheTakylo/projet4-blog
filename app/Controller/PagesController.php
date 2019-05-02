<?php
namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class PagesController extends AbstractController
{

    protected $layout = 'base_layout';

    public function index($param = "dd"): Response
    {

        return $this->render('pages/index.php', []);
    }

}