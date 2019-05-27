<?php

namespace App\Controller;

use App\Entity\Chapter;
use Framework\Http\Response;
use App\Repository\ChapterRepository;
use App\Repository\CommentRepository;
use Framework\Controller\AbstractController;

class AdminController extends AbstractController
{
    
    /** @var ChapterRepository */
    private $chapterRepository;

    /** @var CommentRepository */
    private $commentRepository;

    protected $layout = 'admin_layout';
    
    public function __construct()
    {
        parent::__construct();

        // On vérifie si l'utilisateur esy connecté
        if (!$this->session()->has('admin')) {
            // Si il ne l'est pas, on le rédirige vers la page de connexion
            return $this->redirectTo('security@login', [], 404);
        }

        $this->chapterRepository = $this->getRepository(ChapterRepository::class);
        $this->commentRepository = $this->getRepository(CommentRepository::class);
    }
    
    public function index(): Response
    {
        $hasSpam = $this->commentRepository->count('is_spam', 1);

        return $this->render('admin/index.php', ['hasSpam' => (int) $hasSpam]);
    }
    
    public function chapters(): Response
    {
        $pageNumber = $this->getRequest()->get->get('page') ?? 1;

        $chapters = $this->chapterRepository->findAllWithNbComments($pageNumber);

        return $this->render('admin/chapters/list.php', ['chapters' => $chapters]);
    }
    
    public function chapterDelete($id): Response
    {
        $chapter = $this->chapterRepository->findWhere(['id' => $id]);
        
        if ($chapter) {
            if($this->commentRepository->remove('id', $id)) {
                $this->flash()->add('success', 'Les commentaires associés ont été supprimés');

                if ($this->chapterRepository->remove('id', $id)) {
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
            
            $chapter = new Chapter();
            $chapter->setTitle($data['chapterName']);
            $chapter->setContent($data['chapterContent']);

            if ($this->chapterRepository->save($chapter)) {
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
        /** @var Chapter $chapter */
        $chapter = $this->chapterRepository->findOne(['id' => $id]);

        if(!$chapter) {
            $this->flash()->add('danger', "Le chapitre n'existe pas");
            
            return $this->redirectTo('admin@index');
        }
        
        if ($this->request->getMethod() === 'PUT') {
            $data = $this->request->post->all();
            
            if ($this->chapterRepository->update($data['chapterName'], $data['chapterContent'], $id)) {
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
        $comments = $this->commentRepository->findWhere(['is_spam' => 1]);

        return $this->render('admin/comments/list.php', ['comments' => $comments, 'spamPage' => true]);
    }

    public function commentDelete($id): Response
    {
        if($this->commentRepository->remove('id', $id)) {
            $this->flash()->add('success', 'Le commentaire à bien été supprimé');
        } else {
            $this->flash()->add('danger', 'Erreur, le commentaire n\'a pas été supprimé');
        }

        return $this->referer();
    }

    public function comments(): Response
    {
        $comments = $this->commentRepository->findAllForAdmin();
        
        return $this->render('admin/comments/list.php', ['comments' => $comments]);
    }

}
