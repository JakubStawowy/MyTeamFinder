<?php


class UserController extends AppController
{
    private $userRepository;
    public function __construct(){
        $this->userRepository = new UserRepository();
    }
    public function personalProfile(){
        $user = $this->userRepository->getUserById();
        $this->renderWhenCookiesAreSet('profile', ['user'=>$user]);
    }
}