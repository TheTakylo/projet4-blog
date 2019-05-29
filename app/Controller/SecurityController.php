<?php

namespace App\Controller;

use Framework\Helpers\Captcha\Captcha;
use Framework\Http\Response;
use Framework\Controller\AbstractController;

class SecurityController extends AbstractController
{

    public function login(): Response
    {
        $captcha = new Captcha();

        if ($this->request->getMethod() === 'POST') {
            $admin = $this->config('Application')['Admin'];
            $data = $this->request->post->data();

            if ($captcha->validate($data['inputCaptcha'])) {
                if ($data['email'] === $admin['email'] && $data['password'] === $admin['password']) {
                    $this->session()->set('admin', true);

                    return $this->redirectTo('admin@index');
                } else {
                    $this->flash()->add('danger', 'Identifiants incorrects');
                }
            } else {
                $this->flash()->add('danger', 'Réponse de sécurité incorrecte');
            }
        }

        return $this->render('security/login.php', [
            'captcha' => $captcha
        ]);
    }

    public function logout(): Response
    {
        $this->session()->clear();

        return $this->referer();
    }

}