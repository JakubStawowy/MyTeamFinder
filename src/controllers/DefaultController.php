<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function index(){
        $this->render('login');
    }
    public function register(){
        $this->render('register');
    }
    public function home(){
        $this->render('home');
    }
    public function newEvent(){
        $this->render('newEvent');
    }
    public function profile(){
        $this->render('profile');
    }

}