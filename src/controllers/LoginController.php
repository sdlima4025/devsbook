<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller
{

    public function signin() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signin', [
            'flash' =>$flash
        ]);
    }
    public function signupAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password) {
            $token = LoginHandler::verifyLogin($email, $password);
            if($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            }else {
                $_SESSION['flash'] = 'E-mail e/ou senha não conferem.';
                $this->redirect('/login');
            }
        }else {
            $this->redirect('/login');
        }
    }
    public function signup() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', [
            'flash' =>$flash
        ]);
        
    }
}