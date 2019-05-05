<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;
use App\Model\Chapters;
use App\Model\Comments;

class CommentsController extends AbstractController
{

    public function add($chapter_id): Response
    {
        $chapters = (new Chapters())->findBy('id', $chapter_id);

        if(!$chapters) {
            return $this->redirectTo('pages@index', [], 404);
        }
        
        $request = $this->getRequest();
        
        $data = $request->getData();
        
        $comments = (new Comments());

        if($comments->insert($data['commentEmail'], $data['commentPseudo'], $data['commentContent'], $chapter_id)) {
            return $this->redirectTo('pages@index');
        } else {
            return $this->redirectTo('pages@index', [], 404);
        }
    }

}