<?php

namespace App\Controller;

use Framework\Http\Response;
use App\Repository\ChapterRepository;
use Framework\Controller\AbstractController;

class PagesController extends AbstractController
{

    protected $layout = 'base_layout';

    public function index(): Response
    {
        $chapterRepository = $this->getRepository(ChapterRepository::class);

        $chapters = $chapterRepository->findAllWithNbComments();

        return $this->render('pages/index.php', [
            'chapters' => $chapters
        ]);
    }

    public function search(): Response
    {
        if ($search = $this->getRequest()->get->get('s')) {
            $chapterRepository = $this->getRepository(ChapterRepository::class);
            $chapters = $chapterRepository->findLike('title', $search);
        }

        return $this->render('pages/search.php', [
            'chapters' => $chapters ?? [],
            'search_value' => $search
        ]);
    }

}