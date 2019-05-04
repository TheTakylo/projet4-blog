<?php
namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;
use App\Model\Chapters;

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
        $chapter = (new Chapters())->find($slug);

        if(!$chapter) {
            // chapitre introuvable
            die();
        }

        return $this->render('chapters/show.php', ['chapter' => $chapter]);
    }

}