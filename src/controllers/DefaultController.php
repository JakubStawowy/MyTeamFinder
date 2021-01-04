<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    private $userRepository;
    private $user;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index(){
        if(isset($_COOKIE['name']) && isset($_COOKIE['surname'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
            $this->user = $this->userRepository->getUserById();
        }
        else $this->render('login');
    }
    public function register(){
        $this->render('register');
    }
    public function newEvent(){
        $this->renderWhenCookiesAreSet('newEvent', ['user' => $this->user]);
    }
    public function personalProfile(){
        $this->renderWhenCookiesAreSet('profile', ['user' => $this->user]);
    }
    public function userProfile(){

    }
}