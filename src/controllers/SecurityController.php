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
        try{
            $user = $userRepository->getUser($email);
            if($user->getPassword() != $password){
                $this->render('login', ['messages' => ['Wrong password']]);
            }
            else {
                $userRepository->logUser($user->getId());
//                $url = "http://$_SERVER[HTTP_HOST]";
//                header("Location: {$url}/home");
                $this->render('home', ['user'=>$user]);
            }
        }
        catch (Exception $e){
            $this->render('login', ['messages' => [$e->getMessage()]]);
        }
    }
}