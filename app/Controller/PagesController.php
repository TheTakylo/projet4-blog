<?php
namespace App\Controller;

use App\Model\Chapters;
use Framework\Http\Response;
use App\Repository\ChapterRepository;
use Framework\Controller\AbstractController;

class PagesController extends AbstractController
{
    
    protected $layout = 'base_layout';
    
    public function index(): Response
    {
        $chaptersRepository = $this->getRepository(ChapterRepository::class);

        $chapters = $chaptersRepository->findAll();

        return $this->render('pages/index.php', [
            'chapters' => $chapters,
            'chapters_total' => 0
        ]);
    }

    public function search(): Response
    {
        $request = $this->getRequest();

        // $search = $request->get->get('s');

        return $this->render('pages/search.php');
    }
    
}