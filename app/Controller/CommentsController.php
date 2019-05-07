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
        $chapter = (new Chapters())->findBy('id', $chapter_id);

        if(!$chapter) {
            return $this->redirectTo('pages@index', [], 404);
        }
        
        $request = $this->getRequest();
        
        $data = $request->getData();
        $is_admin = 0;

        if($this->session()->has('admin')) {
            $data['commentPseudo'] = "Jean Forteroche";
            $is_admin = 1;
        }
        
        $comments = (new Comments());

        if($comments->insert($data['commentEmail'], $data['commentPseudo'], $data['commentContent'], $chapter_id, $is_admin)) {
            return $this->redirectTo('chapters@show', ['slug' => $chapter->slug]);
        } else {
            return $this->redirectTo('pages@index', [], 404);
        }
    }

    public function spam($comment_id)
    {
        $comments = (new Comments());

        if(!$comments->findBy('id', $comment_id)) {
            return $this->redirectTo('pages@index', [], 404);
        }

        $comments->markSpam($comment_id);

        return $this->redirectTo('pages@index');
    }

}