<?php


class UserController extends AppController
{
    private $userRepository;
    private $eventRepository;
    private $user;
    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->eventRepository = new EventRepository();
        $this->user = $this->userRepository->getUserById();
    }
    public function personalProfile(){
        $this->renderWhenCookiesAreSet('profile', ['user'=>$this->user]);
    }
    public function userEvents(){
        $events = $this->eventRepository->getEvents('userEvents');
        $this->renderWhenCookiesAreSet('profile', ['events'=>$events, 'user'=>$this->user]);
    }
    public function userSignedEvents(){
        $events = $this->eventRepository->getEvents('userSignedEvents');
        $this->renderWhenCookiesAreSet('profile', ['events'=>$events, 'user'=>$this->user]);
    }
    public function userSettings(){
        $this->renderWhenCookiesAreSet('userSettings', ['user'=>$this->user]);
    }
    public function saveUser(){
        if($this->isPost()){
            $id = $this->user->getId();
            $email = $this->user->getEmail();
            $this->user = new User(
                $id,
                $_POST['name'],
                $_POST['surname'],
                $email,
                $_POST['password'],
                $_POST['country'],
                $_POST['age'],
                $_POST['phone']
            );
            $this->user->setDescription($_POST['description']);
            $this->userRepository->editUser($this->user);
            $this->renderWhenCookiesAreSet('profile', ['user'=>$this->user]);
        }
        else{
            $this->renderWhenCookiesAreSet('userSettings', ['messages'=>["Failed to edit account"]]);
        }
    }
}