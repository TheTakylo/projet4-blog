<?php
namespace App\Controller;

use App\Model\Chapters;
use Framework\Http\Response;
use Framework\Controller\AbstractController;

class PagesController extends AbstractController
{
    
    protected $layout = 'base_layout';
    
    public function index(): Response
    {
        $chapters = (new Chapters())->selectForHome();
        
        return $this->render('pages/index.php', ['chapters' => $chapters]);
    }

    public function search(): Response
    {
        $request = $this->getRequest();

        // $search = $request->get->get('s');

        return $this->render('pages/search.php');
    }
    
}