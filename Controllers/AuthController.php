<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Models\LoginForm;
use App\Models\User;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/login');
                exit;
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register');
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                echo '<br>';
                echo '<br>';
                echo '<br>';
                echo '<br>';
                echo 'logged in';
                $response->redirect('/profile');
                exit;
            }
            return $this->render('login', [
                'model' => $loginForm
            ]);
        }
        return $this->render('login');
    }
}
