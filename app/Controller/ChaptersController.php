<?php
namespace App\Controller;

use Framework\Http\Response;
use App\Repository\ChapterRepository;
use App\Repository\CommentRepository;
use Framework\Controller\AbstractController;

class ChaptersController extends AbstractController
{
    
    protected $layout = 'base_layout';

    /** @var ChapterRepository */
    private $chapterRepository;
    
    public function __construct()
    {
        parent::__construct();

        $this->chapterRepository = $this->getRepository(ChapterRepository::class);
    }

    public function index(): Response
    {
        $pageNumber = $this->getRequest()->get->get('page') ?? 1;

        $chapters = $this->chapterRepository->findAllWithNbComments($pageNumber);

        return $this->render('chapters/index.php', [
            'chapters' => $chapters
         ]);
    }

    public function show(string $slug): Response
    {
        $chapter = $this->chapterRepository->findOne(['slug' => $slug]);

        if(!$chapter) {
            die();
        }

        $commentRepository = $this->getRepository(CommentRepository::class);

        $comments = $commentRepository->findWhere(['chapter_id' => $chapter->getId()]);

        return $this->render('chapters/show.php', ['chapter' => $chapter, 'comments' => $comments]);
    }

}