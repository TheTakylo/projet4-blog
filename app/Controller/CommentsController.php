<?php

namespace App\Controller;

use App\Entity\Comment;
use Framework\Http\Response;
use App\Repository\ChapterRepository;
use App\Repository\CommentRepository;
use Framework\Controller\AbstractController;

class CommentsController extends AbstractController
{
    
    public function add($chapter_id): Response
    {
        $chapterRepository = $this->getRepository(ChapterRepository::class);
        
        $chapter = $chapterRepository->findOne(['id' => $chapter_id]);

        if(!$chapter) {
            return $this->referer();
        }
        
        $commentRepository = $this->getRepository(CommentRepository::class);

        $comment = new Comment();

        $data = $this->request->post->data();

        if($this->session()->has('admin')) {
            $comment->setEmail($this->config('Admin')['email']);
            $comment->setPseudo('Jean Forteroche');
            $comment->setContent($data['commentContent']);
            $comment->setIs_admin(1);
        } else {
            $comment->setEmail($data['commentEmail']);
            $comment->setPseudo($data['commentPseudo']);
        }

        $comment->setContent($data['commentContent']);
        $comment->setChapter_id($chapter_id);
        
        $commentRepository->save($comment);

        return $this->redirectTo('chapters@show', ['slug' => $chapter->getSlug()]);
    }
    
    public function spam($comment_id)
    {
        $commentRepository = $this->getRepository(CommentRepository::class);
        
        if(!$commentRepository->findWhere(['id' => $comment_id])) {
            return $this->referer();
        }
        
        $commentRepository->update(['is_spam' => 1], ['id' => $comment_id]);
        
        return $this->referer();
    }
    
}