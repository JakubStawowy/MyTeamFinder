<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController{

    public function login(){
        $user1 = new User('John', 'Snow', 'John@monkey.com', 'xd');
        $email = $_POST["email"];
        $password = $_POST["password"];
//        if($this->isPost()){
////            $this->login();
//        }

        if($user1->getEmail() != $email){
            $this->render('login', ['messages' => ['User with this email not exist'] ]);
        }
        else if($user1->getPassword() != $password){
            $this->render('login', ['messages' => ['Wrong password']]);
        }
        else {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
    }

}