<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../repository/EventRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SportRepository.php';
require_once __DIR__.'/../managers/EventManager.php';

class EventController extends AppController{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $eventRepository;
    private $eventManager;
    private $userRepository;
    private $sportRepository;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
        $this->userRepository = new UserRepository();
        $this->sportRepository = new SportRepository();
        $this->eventManager = new EventManager();

    }

    public function addEvent(){
        $file = $_FILES['file'];
        $filename = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        if($this->isPost()){
            if(!(is_uploaded_file($file_tmp_name) && $this->validate($file)))
                $filename='no-photo.png';
            try{
                move_uploaded_file($file_tmp_name, dirname(__DIR__).self::UPLOAD_DIRECTORY.$filename);
                $event = new Event(
                    0,
                    $_COOKIE['id'],
                    $_COOKIE['name'].' '.$_COOKIE['surname'],
                    0,
                    new EventDetails(
                        $_POST['title'],
                        $_POST['description'],
                        $filename,
                        $_POST['sport'],
                        $_POST['numberOfPlayers'],
                        $_POST['location'], $_POST['date'].' '.$_POST['time']
                    )
                );
                $this->eventManager->addEvent($event);
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/home");
                return;
            }catch (Exception $e){
                $this->messages[] = $e->getMessage();
            }
        }
        $this->renderIfCookiesAreSet('newevent', ['messages'=>$this->messages]);
    }
    public function filter(){

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : "";
        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->eventRepository->getFilteredEvents($decoded));
        }
    }
    public function search(){

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? $_SERVER["CONTENT_TYPE"] : "";

        if($contentType === "application/json"){
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);


            echo json_encode($this->eventRepository->getEventByTitle($decoded['search']));

        }
    }
//    public function home(){
//        if(isset($_COOKIE['id'])){
//
//            $events = $this->eventRepository->getEvents();
//            $this->user = $this->userRepository->getUserById();
//            $userSignedEvents = $this->userRepository->getUserSignedEvents();
//            $this->renderIfCookiesAreSet('home',[
//                'events' => $events,
//                'user' => $this->user,
//                'userSignedEvents'=>$userSignedEvents
//            ]);
//        }
//        else{
//            $url = "http://$_SERVER[HTTP_HOST]";
//            header("Location: {$url}");
//        }
//    }
    public function eSports(){
        $events = $this->eventRepository->getEvents('esport');
        $this->user = $this->userRepository->getUserById();
        $userSignedEvents = $this->userRepository->getUserSignedEvents();
        $this->renderIfCookiesAreSet('home', [
            'events'=>$events,
            'user' => $this->user,
            'userSignedEvents'=>$userSignedEvents
        ]);
    }
    public function normalSports(){
        $events = $this->eventRepository->getEvents('normal');
        $this->user = $this->userRepository->getUserById();
        $userSignedEvents = $this->userRepository->getUserSignedEvents();
        $this->renderIfCookiesAreSet('home', [
            'events'=>$events,
            'user' => $this->user,
            'userSignedEvents'=>$userSignedEvents
        ]);
    }

    public function removeEvent(){
        if($this->isGet()){
            $this->eventManager->removeEvent($_GET['eventId']);
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/home");
        }
    }

    public function editEvent(){
        if($this->isGet()){
            $this->renderIfCookiesAreSet('editEvent', ['event'=>$this->eventRepository->getEvent($_GET['eventId'])]);
        }
    }
    public function saveEvent() {
        if($this->isPost()){
            $file = $_FILES['file'];
            $filename = $file['name'];
            $file_tmp_name = $file['tmp_name'];
            if(!(is_uploaded_file($file_tmp_name)))
                $filename=$this->eventRepository->getEvent($_POST['eventId'])->getEventDetails()->getImage();
            move_uploaded_file($file_tmp_name, dirname(__DIR__).self::UPLOAD_DIRECTORY.$filename);

            $this->eventManager->editEvent(new Event(
               $_POST['eventId'],
               $_COOKIE['id'],
               '',
               0,
               new EventDetails(
                   $_POST['title'],
                   $_POST['description'],
                   $filename,
                   $_POST['sport'],
                   $_POST['numberOfPlayers'],
                   $_POST['location'],
                   $_POST['date'].' '.$_POST['time']
               )
            ));
        }
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/home");
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
}