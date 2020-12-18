<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../repository/EventRepository.php';
class EventController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];
    private $eventRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    public function addEvent(){
        $file = $_FILES['file'];
        $filename = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        if($this->isPost() && is_uploaded_file($file_tmp_name) && $this->validate($file)){
            try{

                move_uploaded_file($file_tmp_name, dirname(__DIR__).self::UPLOAD_DIRECTORY.$filename);
                $event = new Event($_POST['title'], $_POST['description'], $_POST['sport'], $_POST['numberOfPlayers'], 'krakow', '2020-02-11', $filename);
                $this->eventRepository->addEvent($event);
                $events = $this->eventRepository->getEvents();
                $this->render('home',['events' => $events]);
                return;
            }catch (Exception $e){
                $this->messages[] = $e->getMessage();
            }
        }
        $this->render('newevent', ['messages'=>$this->messages]);
    }
    private function validate(array $file): bool{
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->messages[] = 'file size is too large';
            return false;
        }
        if(!in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->messages[] = 'file type is not supported';
            return false;
        }
        return true;
    }
    public function home(){
        $events = $this->eventRepository->getEvents();
        $this->render('home',['events' => $events]);
    }
    public function eSports(){
        $events = $this->eventRepository->getEvents('esport');
        $this->render('home', ['events'=>$events]);
    }
    public function normalSports(){
        $events = $this->eventRepository->getEvents('normal');
        $this->render('home', ['events'=>$events]);
    }
}