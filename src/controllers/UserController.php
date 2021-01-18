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

    public function userEvents(){
        if($this->isGet()){
            $userProfile = $this->userRepository->getUserById($_GET['userId']);
            $events = $this->eventRepository->getUserEvents($_GET['userId']);
            $this->renderIfCookiesAreSet('profile', ['events'=>$events, 'user'=>$this->user, 'userProfile'=>$userProfile]);
        }
    }
    public function userSignedEvents(){
        if($this->isGet()){
            $userProfile = $this->userRepository->getUserById($_GET['userId']);
            $userSignedEventsIds = $this->userRepository->getUserSignedEvents();
            $events = $this->eventRepository->getUserEvents($_GET['userId'], 'signed');

            $this->renderIfCookiesAreSet('profile', [
                'events'=>$events,
                'user'=>$this->user,
                'userProfile'=>$userProfile,
                'userSignedEvents'=>$userSignedEventsIds
            ]);
        }
    }
    public function userSettings(){
        $this->renderIfCookiesAreSet('userSettings', ['user'=>$this->user]);
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
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/personalProfile");
        }
        else{
            $this->renderIfCookiesAreSet('userSettings', ['messages'=>["Failed to edit account"]]);
        }
    }

    public function leaveComment(){
        if($this->isPost()){
            $this->userManager->addComment($_POST['feedback'], $_POST['userId']);
            $feedback = $this->userRepository->getUserFeedback($_POST['userId']);

//            $url = "http://$_SERVER[HTTP_HOST]";
//            header("Location: {$url}/userProfile");
            $this->render('profile', ['userProfile'=>$this->userRepository->getUserById($_POST['userId']), 'user'=>$this->user, 'feedback'=>$feedback]);
        }
    }

    public function makeAdmin(){
        if($this->isPost()){
            $this->userManager->makeUserAdmin($_POST['userId']);
            $feedback = $this->userRepository->getUserFeedback($_POST['userId']);
            $this->renderIfCookiesAreSet('profile', ['userProfile'=>$this->userRepository->getUserById($_POST['userId']), 'user'=>$this->user, 'feedback'=>$feedback]);
        }
    }
}