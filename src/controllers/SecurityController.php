<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    public function login(){
        $userRepository = new UserRepository();
        if(!$this->isPost()){
            $this->render('login');
            return;
        }
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);

        if($user->getEmail() != $email){
            $this->render('login', ['messages' => ['User with this email not exist'] ]);
        }
    else if($user->getPassword() != $password){
        $this->render('login', ['messages' => ['Wrong password']]);
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
    }

}