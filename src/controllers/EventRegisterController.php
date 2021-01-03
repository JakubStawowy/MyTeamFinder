<?php


class EventRegisterController extends AppController
{
    private $eventRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    public function signUpUserForEvent(){
        if($this->isPost()){
            $userId = $_COOKIE['id'];
            $eventId = $_POST['eventId'];
            try{
                $this->eventRepository->signUpUserToEvent($userId, $eventId);
                $this->render('home', ['messages'=>['You have been succesfully signed up for that event']]);
            }catch (Exception $e){
                if(substr($e->getMessage(), 9, 5) == "23505")
                    $this->render('home', ['messages'=>["You are already signed up for that event"]]);
                else
                    $this->render('home', ['messages'=>[$e->getMessage()]]);
            }
        }
    }
    public function signOut(){
        if($this->isPost()){
            $userId = $_COOKIE['id'];
            $eventId = $_POST['eventId'];
            try{
                $this->eventRepository->signOut($userId, $eventId);
                $this->render('home', ['messages'=>['Success!']]);
            }catch (Exception $e){
                $this->render('home', ['messages'=>['Event removing failure']]);
            }
        }
    }
}