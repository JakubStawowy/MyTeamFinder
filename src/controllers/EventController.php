<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../repository/EventRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/SportRepository.php';

class EventController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $eventRepository;
    private $userRepository;
    private $sportRepository;
    private $user;
    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
        $this->userRepository = new UserRepository();
        $this->sportRepository = new SportRepository();
        $this->user = $this->userRepository->getUserById();

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
                    $_POST['title'],
                    $_POST['description'],
                    $_POST['sport'],
                    $_POST['numberOfPlayers'],
                    'krakow', '2020-02-11',
                    $filename,
                    $_COOKIE['id'],
                    $_COOKIE['name'].' '.$_COOKIE['surname']
                );
                $this->eventRepository->addEvent($event);
                $url = "http://$_SERVER[HTTP_HOST]";
                header("Location: {$url}/home");
                return;
            }catch (Exception $e){
                $this->messages[] = $e->getMessage();
            }
        }
        else{
            $this->messages[] = "nie mna pliku";

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
    public function filterEvents(){
        if($this->isPost()){
            $filters = [];
            if($_POST['free-spots'] != null)
                $filters["number_of_players-signed_players>='"] = $_POST['free-spots'];
            if($_POST['location'] != null)
                $filters["location='"] = $_POST['location'];
            if($_POST['date'] != null)
                $filters["date='"] = $_POST['date'];
            if($_POST['sport'] != null)
                $filters[" sport_name='"] = $_POST['sport'];
            $events = $this->eventRepository->getFilteredEvents($filters);
            $this->render('home', ['events'=>$events]);
        }
        else
            $this->render('home', ['events'=>$this->eventRepository->getEvents(), 'messages'=>['Failed to filter events']]);
    }
    public function search(){
        if($this->isPost()){
            $title = $_POST['search'];
            $events = $this->eventRepository->getFilteredEvents(["title='"=>$title]);
            $this->render('home', ['events'=>$events]);
        }
        else
            $this->render('home', ['events'=>$this->eventRepository->getEvents(), 'messages'=>['Failed to filter events']]);
    }
    public function home(){
        $events = $this->eventRepository->getEvents();
        $normalSports = $this->sportRepository->getSports();
        $eSports = $this->sportRepository->getSports('esport');
        $this->render('home',[
            'events' => $events,
            'user' => $this->user,
            'normalSports' => $normalSports,
            'eSports' => $eSports
        ]);
    }
    public function eSports(){
        $events = $this->eventRepository->getEvents('esport');
        $normalSports = $this->sportRepository->getSports();
        $eSports = $this->sportRepository->getSports('esport');
        $this->render('home', [
            'events'=>$events,
            'user' => $this->user,
            'normalSports' => $normalSports,
            'eSports' => $eSports
        ]);
    }
    public function normalSports(){
        $events = $this->eventRepository->getEvents('normal');
        $normalSports = $this->sportRepository->getSports();
        $eSports = $this->sportRepository->getSports('esport');
        $this->render('home', [
            'events'=>$events,
            'user' => $this->user,
            'normalSports' => $normalSports,
            'eSports' => $eSports
        ]);
    }
}