<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Event.php';

class NewEventController extends AppController{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private $messages = [];

    public function addEvent(){
        $file = $_FILES['file'];
        $filename = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        if($this->isPost() && is_uploaded_file($file_tmp_name) && $this->validate($file)){
            move_uploaded_file($file_tmp_name, dirname(__DIR__).self::UPLOAD_DIRECTORY.$filename);
            $event = new Event($_POST['title'], $_POST['description'], $_POST['sport'], $_POST['numberOfPlayers']);
            $event->setImage($filename);
            $this->render('home', ['messages'=>$this->messages, 'event'=>$event]);
            return;
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
}