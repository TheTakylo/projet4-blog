<?php

namespace App\Controller;

use App\Model\Chapters;
use App\Model\Comments;
use Framework\Http\Response;
use Framework\Controller\AbstractController;

class AdminController extends AbstractController
{
    
    protected $layout = 'admin_layout';
    
    public function __construct()
    {
        parent::__construct();

        // On vérifie si l'utilisateur esy connecté
        if (!$this->session()->has('admin')) {
            // Si il ne l'est pas, on le rédirige vers la page de connexion
            return $this->redirectTo('security@login', [], 404);
        }
    }
    
    public function index(): Response
    {
        $hasSpam = (new Comments())->hasSpam();

        return $this->render('admin/index.php', ['hasSpam' => (int) $hasSpam->total]);
    }
    
    public function chapters(): Response
    {
        $chapters = (new Chapters())->all();
        
        return $this->render('admin/chapters/list.php', ['chapters' => $chapters]);
    }
    
    public function chapterDelete($id): Response
    {
        $chapters = (new Chapters());
        
        $chapter = $chapters->findBy('id', $id);
        
        if ($chapter) {
            $comments = (new Comments());
            
            if($comments->deleteAll($id)) {

                $this->flash()->add('success', 'Les commentaires associés ont été supprimés');

                if ($chapters->delete($id)) {
                    $this->flash()->add('success', "Le chapitre <strong>{$chapter->title}</strong> a bien été Ssupprimé");
                }
                
            } else {
                $this->flash()->add('danger', 'Erreur');
            }
        }
        
        return $this->redirectTo('admin@chapters');
    }
    
    public function chapterNew(): Response
    {
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->post->all();
            
            $chapters = (new Chapters());
            
            if ($chapters->insert($data['chapterName'], $data['chapterContent'])) {
                $this->flash()->add('success', 'Chapitre ajouté');
                return $this->redirectTo('admin@chapters');
            } else {
                $this->flash()->add('danger', 'Erreur');
            }
        }
        
        return $this->render('admin/chapters/form.php');
    }
    
    public function chapterEdit($id): Response
    {
        $chapters = (new Chapters());
        $chapter = $chapters->findBy('id', $id);
        
        if(!$chapter) {
            $this->flash()->add('danger', "Le chapitre n'existe pas");
            
            return $this->redirectTo('admin@index');
        }
        
        if ($this->request->getMethod() === 'PUT') {
            $data = $this->request->post->all();
            
            $chapters = (new Chapters());
            if ($chapters->update($data['chapterName'], $data['chapterContent'], $id)) {
                $this->flash()->add('success', 'Chapitre modifié');
                return $this->redirectTo('admin@chapters');
            } else {
                $this->flash()->add('danger', 'Erreur');
            }
        }
        
        return $this->render('admin/chapters/form.php', ['edit' => true, 'chapter' => $chapter]);
    }
    
    public function commentsSpam(): Response
    {
        $comments = (new Comments())->getSpammed();

        return $this->render('admin/comments/list.php', ['comments' => $comments, 'spamPage' => true]);
    }

    public function commentDelete($id): Response
    {
        $comments = (new Comments());

        if($comments->delete($id)) {
            $this->flash()->add('success', 'Le commentaire à bien été supprimé');
        } else {
            $this->flash()->add('danger', 'Erreur, le commentaire n\'a pas été supprimé');
        }

        return $this->redirectTo('admin@commentsSpam');
    }

    public function comments(): Response
    {
        $comments = (new Comments())->all();
        
        return $this->render('admin/comments/list.php', ['comments' => $comments]);
    }

}
