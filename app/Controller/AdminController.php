<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class AdminController extends AbstractController
{

    protected $layout = 'admin_layout';

    public function __construct()
    {
        // On vérifie si l'utilisateur esy connecté
        if(!$this->session()->has('admin')) {
            // Si il ne l'est pas, on le rédirige vers la page de connexion
            return $this->redirectTo('security@login', 404);
        }
    }
    
    public function index(): Response
    {
        return $this->render('admin/index.php');
    }

}