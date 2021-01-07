<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';

class EventManager extends DatabaseConnector
{
    private $eventRepository;

    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    public function addEvent(Event $event): void{
        $eventDetails = [
            $event->getEventDetails()->getTitle(),
            $event->getEventDetails()->getDescription(),
            $event->getEventDetails()->getNumberOfPlayers(),
            $event->getEventDetails()->getDate(),
            $event->getEventDetails()->getLocation(),
            $event->getEventDetails()->getImage()
        ];
        $this->execute('INSERT INTO event_details VALUES(DEFAULT , ?, ?, ?, ?, ?, ?)', $eventDetails);
        $statement = $this->execute('SELECT id FROM event_details WHERE title=?', [$eventDetails[0]]);
        $id = $statement->fetch()['id'];

        $statement = $this->execute('SELECT id FROM sports WHERE name=?', [$event->getEventDetails()->getSport()]);
        $sportId = $statement->fetch()['id'];

        $this->execute('INSERT INTO events VALUES (DEFAULT, ?,?, ?, DEFAULT)', [$_COOKIE['id'],$sportId, $id]);
    }

    public function signUpUserToEvent($userId, $eventId): bool{
        $event = $this->eventRepository->getEvent($eventId);
        if($event->getSignedPlayers() == $event->getEventDetails()->getNumberOfPlayers())
            return false;
        $this->execute('INSERT INTO players_in_events VALUES(?, ?)', [$userId, $eventId]);
        $statement = $this->execute('SELECT event_details_id FROM events WHERE id=?', [$eventId]);
        $eventDetailsId = $statement->fetch()['event_details_id'];
        $this->execute('UPDATE event_details SET signed_players = signed_players+1 WHERE id=?', [$eventDetailsId]);
        return true;
    }

    public function signOut($userId, $eventId){

        $statement = $this->execute('SELECT event_details_id FROM events WHERE id=?', [$eventId]);
        $eventDetailsId = $statement->fetch()['event_details_id'];

        if($this->eventRepository->getEvent($eventId)->getAddedById() != $userId){
            $this->execute('DELETE FROM players_in_events WHERE user_id=? AND event_id=?', [$userId, $eventId]);
            $this->execute('UPDATE event_details SET signed_players = signed_players-1 WHERE id=?', [$eventDetailsId]);
        }
        else{
            $this->execute('DELETE FROM players_in_events WHERE event_id=?', [$eventId]);
            $this->execute('DELETE FROM events WHERE id=?', [$eventId]);
            $this->execute('DELETE FROM event_details WHERE id=?', [$eventDetailsId]);
        }
    }

    public function removeEvent($eventId){
        $event_details_id = $this->eventRepository->getEventDetailsId($this->getEvent($eventId));
        $this->execute("DELETE FROM events WHERE id=?", [$eventId]);
        $this->execute("DELETE FROM event_details WHERE id=?", [$event_details_id]);
    }

}