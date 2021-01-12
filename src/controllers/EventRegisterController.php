<?php


class EventRegisterController extends AppController
{
    private $eventRepository;
    private $eventManager;

    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
        $this->eventManager = new EventManager();
    }

    public function signUp(int $id){
        $this->eventManager->signUpUserToEvent($_COOKIE['id'], $id);
        http_response_code(200);
    }

    public function signUpUserForEvent(int $eventId){
        try{
            $this->eventManager->signUpUserToEvent($_COOKIE['id'], $eventId);
            http_response_code(200);
        }catch (Exception $e){
            if(substr($e->getMessage(), 9, 5) == "23505")
                $this->render('home', ['messages'=>["You are already signed up for that event"]]);
            else
                $this->render('home', ['messages'=>[$e->getMessage()]]);
        }

    }
    public function signOut(){
        if($this->isPost()){
            $userId = $_COOKIE['id'];
            $eventId = $_POST['eventId'];
            try{
                $this->eventManager->signOut($userId, $eventId);
                $this->render('home', ['messages'=>['Success!']]);
            }catch (Exception $e){
                $this->render('home', ['messages'=>['Event removing failure']]);
            }
        }
    }
}