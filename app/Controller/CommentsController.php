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
            return $this->referer();
        }
        
        $is_admin = 0;
        $data = $this->request->post->data();
        
        if($this->session()->has('admin')) {
            $data['commentEmail'] = $this->config('Admin')['email'];
            $data['commentPseudo'] = "Jean Forteroche";
            $is_admin = 1;
        }
        
        (new Comments())->insert($data, $chapter_id, $is_admin);

        return $this->redirectTo('chapters@show', ['slug' => $chapter->slug]);
    }
    
    public function spam($comment_id)
    {
        $comments = (new Comments());
        
        if(!$comments->findBy('id', $comment_id)) {
            return $this->referer();
        }
        
        $comments->markSpam($comment_id);
        
        return $this->referer();
    }
    
}