<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function index(){
        if(isset($_COOKIE['name']) && isset($_COOKIE['surname'])){
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
        else $this->render('login');
    }
    public function register(){
        $this->render('register');
    }
    public function newEvent(){
        $this->renderWhenCookiesAreSet('newEvent');
    }
    public function personalProfile(){
        $this->renderWhenCookiesAreSet('profile');
    }
    public function userProfile(){

    }
}