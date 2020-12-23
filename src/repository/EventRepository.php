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

//        create view event_view as select events.id, events.sport_id,events.created_at, event_details.title, event_details.description, event_details.number_of_players,
//        event_details.location, event_details.date, event_details.image, events.created_by,
//        event_details.signed_players, sports.name as sport_name, user_details.name as username, user_details.surname
//        from events inner join event_details on (events.event_details_id=event_details.id)
//        inner join sports on (events.sport_id=sports.id) inner join users on (events.created_by=users.id) inner join user_details on (users.user_details_id=user_details.id);
//        //getting event from database
        $statement = $this->prepareStatement('SELECT * FROM event_view WHERE id=:id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
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
        $statement = $this->prepareStatement('INSERT INTO event_details VALUES(DEFAULT , ?, ?, ?, ?, ?, ?)');
        $statement->execute($eventDetails);

        $statement = $this->prepareStatement('SELECT id FROM event_details WHERE title=?');
        $statement->execute([$eventDetails[0]]);
        $id = $statement->fetch()['id'];

        $statement = $this->prepareStatement('SELECT id FROM sports WHERE name=?');
        $statement->execute([$event->getSport()]);
        $sportId = $statement->fetch()['id'];

        $statement = $this->prepareStatement('INSERT INTO events VALUES (DEFAULT, ?,?, ?, DEFAULT)');
        $statement->execute([$_COOKIE['id'],$sportId, $id]);

    }
    public function getEvents($type = null): array{
        $results = [];
        switch ($type){
            case 'esport':
            case 'normal':
                $statement = $this->prepareStatement('SELECT * FROM event_view WHERE sport_type=? ORDER BY created_at;');
                $statement->execute([$type]);
                break;
            case 'userEvents':
                $statement = $this->prepareStatement('SELECT * FROM event_view WHERE created_by=? ORDER BY created_at;');
                $statement->execute([$_COOKIE['id']]);
                break;
            case 'userSignedEvents':
                $statement = $this->prepareStatement('SELECT event_id FROM players_in_events WHERE user_id=?');
                $statement->execute([$_COOKIE['id']]);
                $eventIds = $statement->fetchAll(PDO::FETCH_ASSOC);
                $query = 'SELECT * FROM event_view WHERE';
                foreach ($eventIds as $eventId){
                    $query = $query.' id='.$eventId['event_id'].' OR';
                }
                $query = substr($query, 0, -3);
                $query = $query.' ORDER BY created_at';
                $statement = $this->prepareStatement($query);
                $statement->execute();
                break;
            default:
                $statement = $this->prepareStatement('SELECT * FROM event_view ORDER BY created_at;');
                $statement->execute();
        }
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event){
            $results[] = $this->createEvent($event);
        }
        return $results;
    }
    public function signUpUserToEvent($userId, $eventId){
        $statement = $this->prepareStatement('INSERT INTO players_in_events VALUES(?, ?)');
        $statement->execute([$userId, $eventId]);

        $statement = $this->prepareStatement('SELECT event_details_id FROM events WHERE id=?');
        $statement->execute([$eventId]);
        $eventDetailsId = $statement->fetch()['event_details_id'];

        $statement = $this->prepareStatement('UPDATE event_details SET signed_players = signed_players+1 WHERE id=?');
        $statement->execute([$eventDetailsId]);
    }
    public function signOut($userId, $eventId){

        $statement = $this->prepareStatement('SELECT event_details_id FROM events WHERE id=?');
        $statement->execute([$eventId]);
        $eventDetailsId = $statement->fetch()['event_details_id'];

        if($this->getEvent($eventId)->getAddedById() != $userId){

            $statement = $this->prepareStatement('DELETE FROM players_in_events WHERE user_id=? AND event_id=?');
            $statement->execute([$userId, $eventId]);


            $statement = $this->prepareStatement('UPDATE event_details SET signed_players = signed_players-1 WHERE id=?');
            $statement->execute([$eventDetailsId]);
        }
        else{
            $statement = $this->prepareStatement('DELETE FROM players_in_events WHERE event_id=?');
            $statement->execute([$eventId]);

            $statement = $this->prepareStatement('DELETE FROM events WHERE id=?');
            $statement->execute([$eventId]);

            $statement = $this->prepareStatement('DELETE FROM event_details WHERE id=?');
            $statement->execute([$eventDetailsId]);
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
        $statement = $this->prepareStatement($query);
        $statement->execute();
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event){
            $results[] = $this->createEvent($event);
        }
        return $results;
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