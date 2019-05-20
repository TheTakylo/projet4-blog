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
        $chapterRepository = $this->getRepository(ChapterRepository::class);

        $chapters = $chapterRepository->findAllJoin(Comment::class, 'id', 'chapter_id');

        return $this->render('pages/index.php', [
            'chapters' => $chapters,
            'chapters_total' => 0
        ]);
    }

    public function search(): Response
    {
        $request = $this->getRequest();

        $chapters = [];

        if($search = $request->get->get('s')) {
            $chapterRepository = $this->getRepository(ChapterRepository::class);
            $chapters = $chapterRepository->findLike('title', $search);
        }

        return $this->render('pages/search.php', [
            'chapters' => $chapters
        ]);
    }
    
}