<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    private $userRepository;
    private $eventRepository;
    private $sportRepository;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->eventRepository = new EventRepository();
        $this->sportRepository = new SportRepository();
    }

    public function index(){
        if(isset($_COOKIE['id'])){
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
        $this->user = $this->userRepository->getUserById();
        $this->renderIfCookiesAreSet('newEvent', ['user' => $this->user]);
    }
    public function event(){
        if($this->isGet()){
            $this->user = $this->userRepository->getUserById();
            $this->renderIfCookiesAreSet('eventPage', [
                'user'=>$this->user,
                'event'=>$this->eventRepository->getEvent($_GET['eventId']),
                'userSignedEvents'=>$this->userRepository->getUserSignedEvents()
            ]);
        }
    }
    public function personalProfile(){
        $this->user = $this->userRepository->getUserById();
        $feedback = $this->userRepository->getUserFeedback($_COOKIE['id']);
        $this->renderIfCookiesAreSet('profile', ['user' => $this->user, 'userProfile' => $this->user, 'feedback'=>$feedback]);
    }
    public function userProfile(){
        if($this->isPost()){
            $this->user = $this->userRepository->getUserById();
            $user = $this->userRepository->getUserById($_POST['userId']);
            $feedback = $this->userRepository->getUserFeedback($_POST['userId']);
            $this->renderIfCookiesAreSet('profile', ['user' => $this->user, 'userProfile' => $user, 'feedback'=>$feedback]);
        }
    }

    public function addSport(string $sport){
        $sportDetails = explode('+', $sport);
        $this->sportRepository->addSport($sportDetails[0], $sportDetails[1]);
    }
}