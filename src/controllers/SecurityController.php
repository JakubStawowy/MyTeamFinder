<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{

    private $userRepository;
    private $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->userManager = new UserManager();
    }

    public function login(){
        if(!$this->isPost()){
            $this->render('login');
            return;
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user = $this->userRepository->getUser($email);
        if($user != null){
            if($user->getPassword() != $password){
                $this->render('login', ['messages' => ['Wrong password']]);
            }
            else {
                $this->userManager->logUser($user->getId());
                setcookie('name', $user->getUserDetails()->getName(), time()+(86400 * 30), "/");
                setcookie('surname', $user->getUserDetails()->getSurname(), time()+(86400 * 30), "/");
                setcookie('id', $user->getId(), time()+(86400 * 30), "/");
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/home");
            }
        }
        else{
            $this->render('login', ['messages'=>['Wrong email']]);
        }
    }

    public function logout(){
        if(isset($_COOKIE['name']) || isset($_COOKIE['surname']) || isset($_COOKIE['id'])){
            unset($_COOKIE['name']);
            unset($_COOKIE['surname']);
            unset($_COOKIE['id']);
            setcookie('name', null, -1, '/');
            setcookie('surname', null, -1, '/');
            setcookie('id', null, -1, '/');
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}");
    }

    public function registerUser(){
        if (!$this->isPost()) {
            $this->render('register');
            return;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];
        $phone = $_POST['phone'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $age = $_POST['age'];
        $country = $_POST['country'];

        if ($password !== $confirmedPassword) {
            $this->render('register', ['messages' => ["Please provide proper password"]]);
            return;
        }

        if($this->userManager->registerUser(new User(
            0,
            $email,
            $password,
            new UserDetails(
                $name,
                $surname,
                $phone,
                ' ',
                $country,
                $age,
                'no-photo.png'
            )
        ))){
            $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
        }
        else{
            $this->render('register', ['messages' => ["There were problems with registration. Try to register again"]]);
        }

    }
}