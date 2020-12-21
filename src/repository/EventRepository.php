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

        //getting event from database
        $statement = $this->prepareStatement('SELECT * FROM public.events where id = :id;');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $event = $statement->fetch(PDO::FETCH_ASSOC);

        //getting event details from database
        $statement = $this->prepareStatement('SELECT * FROM public.event_details where id = :id;');
        $statement->bindParam(':id', $event['event_details_id'], PDO::PARAM_INT);
        $statement->execute();
        $eventDetails = $statement->fetch();

        //getting sport name from database
        $statement = $this->prepareStatement('SELECT * FROM public.sports where id = :id;');
        $statement->bindParam(':id', $event['sport_id'], PDO::PARAM_INT);
        $statement->execute();
        $sport = $statement->fetch();

        return new Event(
            $event['id'],
            $eventDetails['title'],
            $eventDetails['description'],
            $sport['name'],
            $eventDetails['number_of_players'],
            $eventDetails['location'],
            $eventDetails['date'],
            $eventDetails['image'],
            $event['created_by'],
            $this->userRepository->getUserNameSurname($event['created_by']),
            $eventDetails['signed_players']
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
                $statement = $this->prepareStatement('SELECT id FROM sports WHERE type=:sportType;');
                $statement->bindParam(':sportType', $type, PDO::PARAM_STR);
                $statement->execute();
                $sportIds = $statement->fetchAll(PDO::FETCH_ASSOC);
                $query = 'SELECT id FROM events WHERE ';
                $sportIdsArray = [];
                foreach ($sportIds as $sportId){
                    $query = $query.' sport_id=? or ';
                    $sportIdsArray[] = $sportId['id'];
                }
                $query = substr($query, 0, -4);
                $query = $query.' ORDER BY created_at DESC;';
                $statement = $this->prepareStatement($query);
                $statement->execute($sportIdsArray);
                $eventIds = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($eventIds as $eventId) {
                    $results[] = $this->getEvent($eventId['id']);
                }
                break;
            default:
                $statement = $this->prepareStatement('SELECT id FROM events ORDER BY created_at DESC;');
                $statement->execute();
                $eventIds = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($eventIds as $eventId){
                    $results[] = $this->getEvent($eventId['id']);
                }
        }
        return $results;
    }
    public function assignUserToEvent($userId, $eventId){
        try{
            $statement = $this->prepareStatement('INSERT INTO players_in_events VALUES(?, ?)');
            $statement->execute([$userId, $eventId]);
            $statement = $this->prepareStatement('SELECT event_details_id FROM events WHERE id=?');
            $statement->execute([$eventId]);

            $eventDetailsId = $statement->fetch()['event_details_id'];
            $statement = $this->prepareStatement('UPDATE event_details SET signed_players = signed_players+1 WHERE id=?');
            $statement->execute([$eventDetailsId]);
            return true;
        }catch (Exception $ignored){
            return false;
        }
    }
}