<?php

require_once __DIR__.'/../managers/UserManager.php';

class UserController extends AppController
{
    private $userRepository;
    private $userManager;
    private $eventRepository;
    private $user;

    const UPLOAD_DIRECTORY = '/../public/uploads/';
    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->userManager = new UserManager();
        $this->eventRepository = new EventRepository();
        $this->user = $this->userRepository->getUserById();
    }
    public function personalProfile(){
        $this->renderWhenCookiesAreSet('profile', ['user'=>$this->user]);
    }
    public function userEvents(){
        $events = $this->eventRepository->getEvents('userEvents');
        $this->renderWhenCookiesAreSet('profile', ['events'=>$events, 'user'=>$this->user, 'userProfile'=>$this->user]);
    }
    public function userSignedEvents(){
        $events = $this->eventRepository->getEvents('userSignedEvents');
        $this->renderWhenCookiesAreSet('profile', ['events'=>$events, 'user'=>$this->user, 'userProfile'=>$this->user]);
    }
    public function userSettings(){
        $this->renderWhenCookiesAreSet('userSettings', ['user'=>$this->user]);
    }
    public function saveUser(){
        $file = $_FILES['image'];
        $filename = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        if($_POST['password'] == null)
            $password = $this->userRepository->getUserById($_COOKIE['id'])->getPassword();
        else if($_POST['password'] == $_POST['confirmedPassword'])
            $password = $_POST['password'];
        else
            $password = $this->userRepository->getUserById($_COOKIE['id'])->getPassword();

        if($this->isPost()){
            if(!(is_uploaded_file($file_tmp_name)))
                $filename=$this->userRepository->getUserById()->getUserDetails()->getImage();
            move_uploaded_file($file_tmp_name, dirname(__DIR__).self::UPLOAD_DIRECTORY.$filename);
            $id = $this->user->getId();
            $email = $this->user->getEmail();
            $role = $this->user->getRole();
            $this->user = new User(
                $id,
                $email,
                $password,
                new UserDetails(
                    $_POST['name'],
                    $_POST['surname'],
                    $_POST['phone'],
                    $_POST['description'],
                    $_POST['country'],
                    $_POST['age'],
                    $filename
                ),
                $role
            );
            $this->userManager->editUser($this->user);
            $this->renderWhenCookiesAreSet('profile', ['user'=>$this->user, 'userProfile'=>$this->user]);
        }
        else{
            $this->renderWhenCookiesAreSet('userSettings', ['messages'=>["Failed to edit account"]]);
        }
    }

    public function leaveComment(){
        if($this->isPost()){
            $this->userManager->addComment($_POST['feedback'], $_POST['userId']);
            $feedback = $this->userRepository->getUserFeedback($_POST['userId']);
            $this->render('profile', ['userProfile'=>$this->userRepository->getUserById($_POST['userId']), 'user'=>$this->user, 'feedback'=>$feedback]);
        }
    }

    public function makeAdmin(){
        if($this->isPost()){
            $this->userManager->makeUserAdmin($_POST['userId']);
            $feedback = $this->userRepository->getUserFeedback($_POST['userId']);
            $this->renderWhenCookiesAreSet('profile', ['userProfile'=>$this->userRepository->getUserById($_POST['userId']), 'user'=>$this->user, 'feedback'=>$feedback]);
        }
    }
}