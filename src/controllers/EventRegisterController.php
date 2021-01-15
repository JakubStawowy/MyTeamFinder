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

    public function signUpUserForEvent(int $eventId){
        if($this->eventManager->signUpUserToEvent($_COOKIE['id'], $eventId)){
            http_response_code(200);
        }
        else http_response_code(409);

    }

    public function signOutUserFromEvent(int $eventId){
        $this->eventManager->signOut($_COOKIE['id'], $eventId);
        http_response_code(200);
    }
}