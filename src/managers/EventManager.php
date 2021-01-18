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

        $PDOConnection = $this->getPDOConnection();

        try{
            $eventDetails = [
                $event->getEventDetails()->getTitle(),
                $event->getEventDetails()->getDescription(),
                $event->getEventDetails()->getNumberOfPlayers(),
                $event->getEventDetails()->getLocation(),
                $event->getEventDetails()->getImage(),
                $event->getEventDetails()->getDate()
            ];
            $this->executePDOConnection($PDOConnection, 'INSERT INTO event_details VALUES(DEFAULT , ?, ?, ?, ?, ?, DEFAULT, ?)', $eventDetails);
            $id = $PDOConnection->lastInsertId();
            $statement = $this->executePDOConnection($PDOConnection, 'SELECT id FROM sports WHERE name=?', [$event->getEventDetails()->getSport()]);
            $sportId = $statement->fetch()['id'];
            $this->executePDOConnection($PDOConnection, 'INSERT INTO events VALUES (DEFAULT, ?,?, ?, DEFAULT)', [$_COOKIE['id'],$sportId, $id]);

        } catch (PDOException $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
        }
    }

    public function signUpUserToEvent($userId, $eventId): bool{
        $PDOConnection = $this->getPDOConnection();
        try{
            $event = $this->eventRepository->getEvent($eventId);
            if($event->getSignedPlayers() == $event->getEventDetails()->getNumberOfPlayers())
                return false;
            $this->executePDOConnection($PDOConnection, 'INSERT INTO players_in_events VALUES(?, ?)', [$userId, $eventId]);
            $statement = $this->executePDOConnection($PDOConnection, 'SELECT event_details_id FROM events WHERE id=?', [$eventId]);
            $eventDetailsId = $statement->fetch()['event_details_id'];
            $this->executePDOConnection($PDOConnection, 'UPDATE event_details SET signed_players = signed_players+1 WHERE id=?', [$eventDetailsId]);

            return true;
        } catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
            return false;
        }
    }

    public function signOut($userId, $eventId){
        $PDOConnection = $this->getPDOConnection();
        try{
            $statement = $this->executePDOConnection($PDOConnection, 'SELECT event_details_id FROM events WHERE id=?', [$eventId]);
            $eventDetailsId = $statement->fetch()['event_details_id'];

            if($this->eventRepository->getEvent($eventId)->getAddedById() != $userId){
                $this->executePDOConnection($PDOConnection, 'DELETE FROM players_in_events WHERE user_id=? AND event_id=?', [$userId, $eventId]);
                $this->executePDOConnection($PDOConnection, 'UPDATE event_details SET signed_players = signed_players-1 WHERE id=?', [$eventDetailsId]);
            }
            else{
                $this->executePDOConnection($PDOConnection, 'DELETE FROM players_in_events WHERE event_id=?', [$eventId]);
                $this->executePDOConnection($PDOConnection, 'DELETE FROM events WHERE id=?', [$eventId]);
                $this->executePDOConnection($PDOConnection, 'DELETE FROM event_details WHERE id=?', [$eventDetailsId]);
            }
        } catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
        }
    }

    public function removeEvent($eventId){
        $PDOConnection = $this->getPDOConnection();
        try{
            $event_details_id = $this->eventRepository->getEventDetailsId($eventId);
            $this->executePDOConnection($PDOConnection, "DELETE FROM events WHERE id=?", [$eventId]);
            $this->executePDOConnection($PDOConnection, "DELETE FROM event_details WHERE id=?", [$event_details_id]);
        }catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
        }
    }

    public function editEvent(Event $event){
        $PDOConnection = $this->getPDOConnection();
        try{

            $this->executePDOConnection($PDOConnection, '
                UPDATE event_details SET title=?, description=?, number_of_players=?, location=?, image=?, date=? WHERE id=?;
            ', [
                $event->getEventDetails()->getTitle(),
                $event->getEventDetails()->getDescription(),
                $event->getEventDetails()->getNumberOfPlayers(),
                $event->getEventDetails()->getLocation(),
                $event->getEventDetails()->getImage(),
                $event->getEventDetails()->getDate(),
                $this->eventRepository->getEventDetailsId($event->getId())
            ]);
        } catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
        }

    }

}