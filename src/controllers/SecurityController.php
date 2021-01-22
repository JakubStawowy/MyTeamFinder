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
            if(!password_verify($password, $user->getPassword())){
                $this->render('login', ['messages' => ['Wrong password']]);
            }
            else {
                $this->userManager->logUser($user->getId());
                setcookie('id', $user->getId(), time()+600, "/");
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/home");
            }
        }
        else{
            $this->render('login', ['messages'=>['Wrong email']]);
        }
    }

    public function logout(){
        if(isset($_COOKIE['id'])){
            $this->userManager->logoutUser($_COOKIE['id']);
            unset($_COOKIE['id']);
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
            password_hash($password, PASSWORD_DEFAULT),
            new UserDetails(
                $name,
                $surname,
                $phone,
                ' ',
                $country,
                $age,
                'no-photo.png'
            ),
            'normal'
        ))){
            $this->render('login', ['messages' => ['You\'ve been succesfully registrated!']]);
        }
        else{
            $this->render('register', ['messages' => ["There were problems with registration. Try to register again"]]);
        }

    }
}