<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;
use App\Model\Chapters;

class AdminController extends AbstractController
{

    protected $layout = 'admin_layout';

    public function __construct()
    {
        // On vérifie si l'utilisateur esy connecté
        if (!$this->session()->has('admin')) {
            // Si il ne l'est pas, on le rédirige vers la page de connexion
            return $this->redirectTo('security@login', 404);
        }
    }

    public function index(): Response
    {
        return $this->render('admin/index.php');
    }

    public function chapters(): Response
    {
        $chapters = (new Chapters())->all();

        return $this->render('admin/chapters/list.php', ['chapters' => $chapters]);
    }

    public function chapterDelete(int $id): Response
    {
        $chapters = (new Chapters());

        $chapter = $chapters->findBy('id', $id);

        if ($chapter) {
            if ($chapters->delete($id)) {
                $this->flash()->add('success', 'Chapitre supprimé');
            } else {
                $this->flash()->add('error', 'Erreur');
            }
        }

        return $this->redirectTo('admin@chapters');
    }

    public function chapterNew(): Response
    {
        $request = $this->getRequest();

        if ($request->getMethod() === 'POST') {
            $data = $request->getData();

            $chapters = (new Chapters());

            if ($chapters->insert($data['chapterName'], $data['chapterContent'])) {
                $this->flash()->add('success', 'Chapitre ajouté');
            } else {
                $this->flash()->add('error', 'Erreur');
            }
        }

        return $this->render('admin/chapters/form.php');
    }
}
