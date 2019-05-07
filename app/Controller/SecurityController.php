<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class SecurityController extends AbstractController
{

    public function login(): Response
    {
        if($this->request->getMethod() === 'POST') {
            $admin = $this->config('Admin');
            $data = $this->request->post->data();

            if($data['email'] === $admin['email'] && $data['password'] === $admin['password']) {
                $this->session()->set('admin', true);

                return $this->redirectTo('admin@index');
            } else {
                $this->flash()->add('danger', 'Identifiants incorrects');
            }
        }

        return $this->render('security/login.php');
    }

    public function logout()
    {
        $this->session()->clear();

        return $this->redirectTo('pages@index');
    }

}