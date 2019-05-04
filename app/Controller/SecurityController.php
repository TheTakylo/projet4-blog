<?php

namespace App\Controller;

use Framework\Http\Response;
use Framework\Controller\AbstractController;

class SecurityController extends AbstractController
{

    public function login(): Response
    {
        $data = [];
        $request = $this->getRequest();

        if($request->getMethod() === 'POST') {
            $admin = $this->config('Admin');
            $form = $request->getData();

            if($form['username'] === $admin['username'] && $form['password'] === $admin['password']) {
                $this->session()->set('admin', true);

                return $this->redirectTo('admin@index');
            } else {
                $data['form_error'] = true;
            }
        }

        return $this->render('security/login.php', $data);
    }

    public function logout()
    {
        $this->session()->clear();

        return $this->redirectTo('pages@index');
    }

}