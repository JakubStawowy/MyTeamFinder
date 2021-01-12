<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    private $userRepository;
    private $eventRepository;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->eventRepository = new EventRepository();
        $this->user = $this->userRepository->getUserById();
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
//        $this->user = $this->userRepository->getUserById();
        $this->renderWhenCookiesAreSet('newEvent', ['user' => $this->user]);
    }
    public function event(){
        if($this->isGet()){
//            $this->user = $this->userRepository->getUserById();
            $this->renderWhenCookiesAreSet('eventPage', ['user'=>$this->user, 'event'=>$this->eventRepository->getEvent($_GET['eventId'])]);
        }
    }
    public function personalProfile(){
//        $this->user = $this->userRepository->getUserById();
        $feedback = $this->userRepository->getUserFeedback($_COOKIE['id']);
        $this->renderWhenCookiesAreSet('profile', ['user' => $this->user, 'userProfile' => $this->user, 'feedback'=>$feedback]);
    }
    public function userProfile(){
        if($this->isGet()){
//            $this->user = $this->userRepository->getUserById();
            $user = $this->userRepository->getUserById($_GET['userId']);
            $feedback = $this->userRepository->getUserFeedback($_GET['userId']);
            $this->renderWhenCookiesAreSet('profile', ['user' => $this->user, 'userProfile' => $user, 'feedback'=>$feedback]);
        }
    }
}