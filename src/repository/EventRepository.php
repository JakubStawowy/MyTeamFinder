<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class EventRepository extends Repository
{
    private $userRepository;
    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function getEvent(int $id): ?Event{
        $statement = $this->execute('SELECT * FROM event_view WHERE id=?', [$id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Event(
            $result['id'],
            $result['title'],
            $result['description'],
            $result['sport_name'],
            $result['number_of_players'],
            $result['location'],
            $result['date'],
            $result['image'],
            $result['created_by'],
            $result['username'].' '.$result['surname'],
            $result['signed_players']
        );
    }
    public function addEvent(Event $event): void{
        $eventDetails = [
            $event->getTitle(),
            $event->getDescription(),
            $event->getNumberOfPlayers(),
            $event->getDate(),
            $event->getLocation(),
            $event->getImage()
        ];
        $this->execute('INSERT INTO event_details VALUES(DEFAULT , ?, ?, ?, ?, ?, ?)', $eventDetails);
        $statement = $this->execute('SELECT id FROM event_details WHERE title=?', [$eventDetails[0]]);
        $id = $statement->fetch()['id'];

        $statement = $this->execute('SELECT id FROM sports WHERE name=?', [$event->getSport()]);
        $sportId = $statement->fetch()['id'];

        $this->execute('INSERT INTO events VALUES (DEFAULT, ?,?, ?, DEFAULT)', [$_COOKIE['id'],$sportId, $id]);
    }
    public function getEvents($type = null): array{
        $results = [];
        switch ($type){
            case 'esport':
            case 'normal':
                $statement = $this->execute('SELECT * FROM event_view WHERE sport_type=? ORDER BY created_at DESC', [$type]);
                break;
            case 'userEvents':
                $statement = $this->execute('SELECT * FROM event_view WHERE created_by=? ORDER BY created_at DESC', [$_COOKIE['id']]);
                break;
            case 'userSignedEvents':
                $statement = $this->execute('SELECT event_id FROM players_in_events WHERE user_id=?', [$_COOKIE['id']]);
                $eventIds = $statement->fetchAll(PDO::FETCH_ASSOC);
                $query = 'SELECT * FROM event_view WHERE';
                foreach ($eventIds as $eventId){
                    $query = $query.' id='.$eventId['event_id'].' OR';
                }
                $query = substr($query, 0, -3);
                $query = $query.' ORDER BY created_at DESC';
                $statement = $this->execute($query);
                break;
            default:
                $statement = $this->execute('SELECT * FROM event_view ORDER BY created_at DESC;');
        }
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event){
            $results[] = $this->createEvent($event);
        }
        return $results;
    }
    public function signUpUserToEvent($userId, $eventId): bool{
        $event = $this->getEvent($eventId);
        if($event->getSignedPlayers() == $event->getNumberOfPlayers())
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

        if($this->getEvent($eventId)->getAddedById() != $userId){
            $this->execute('DELETE FROM players_in_events WHERE user_id=? AND event_id=?', [$userId, $eventId]);
            $this->execute('UPDATE event_details SET signed_players = signed_players-1 WHERE id=?', [$eventDetailsId]);
        }
        else{
            $this->execute('DELETE FROM players_in_events WHERE event_id=?', [$eventId]);
            $this->execute('DELETE FROM events WHERE id=?', [$eventId]);
            $this->execute('DELETE FROM event_details WHERE id=?', [$eventDetailsId]);
        }
    }
    public function getFilteredEvents(array $filters): array{
        $results = [];
        $query = 'SELECT * FROM event_view WHERE ';
        if(!empty($filters)){
            foreach (array_keys($filters) as $key){
                $query = $query.$key.$filters[$key]."' AND ";
            }
            $query = substr($query, 0, -4);
        }
        else
            $query = substr($query, 0, -6);
        $query = $query.' ORDER BY created_at';
        $statement = $this->execute($query);
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event){
            $results[] = $this->createEvent($event);
        }
        return $results;
    }
    public function getEventByTitle(string $title): array{

        $title = '%'.strtolower($title).'%';
        $statement = $this->execute('SELECT * FROM event_view WHERE LOWER(title) LIKE ? OR LOWER(description) LIKE ? ORDER BY created_at', [$title, $title]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    private function createEvent(array $event): Event{
        return new Event(
            $event['id'],
            $event['title'],
            $event['description'],
            $event['sport_name'],
            $event['number_of_players'],
            $event['location'],
            $event['date'],
            $event['image'],
            $event['created_by'],
            $event['username'].' '.$event['surname'],
            $event['signed_players']
        );
    }
}