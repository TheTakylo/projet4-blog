<?php
namespace App\Controller;

use App\Model\Chapters;
use App\Model\Comments;
use Framework\Http\Response;
use Framework\Controller\AbstractController;

class ChaptersController extends AbstractController
{
    
    protected $layout = 'base_layout';

    public function index(): Response
    {

        $chapters = (new Chapters())->all();

        return $this->render('chapters/index.php', ['chapters' => $chapters]);
    }

    public function show(string $slug): Response
    {
        $chapter = (new Chapters())->findBy('slug', $slug);

        if(!$chapter) {
            // chapitre introuvable
            die();
        }

        $comments = (new Comments())->getAll($chapter->id);

        return $this->render('chapters/show.php', ['chapter' => $chapter, 'comments' => $comments]);
    }

}