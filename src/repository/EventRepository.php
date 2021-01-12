<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/EventDetails.php';
require_once __DIR__.'/../models/Event.php';

class EventRepository extends DatabaseConnector
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function test(){
        $this->execute("insert into test values (4, 3)");
    }
    public function getEvent(int $id): ?Event{
        $statement = $this->execute('SELECT * FROM event_view WHERE id=?', [$id]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->createEvent($result);
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

    public function getEventDetailsId(Event $event): int{
        $statement = $this->execute("
            SELECT id FROM event_details WHERE title=? AND description=? AND date=? AND location=?
        ", [
            $event->getEventDetails()->getTitle(),
            $event->getEventDetails()->getDescription(),
            $event->getEventDetails()->getDate(),
            $event->getEventDetails()->getLocation()
        ]);

        return $statement->fetch()['id'];
    }

    private function createEvent(array $event): Event{
        return new Event(
            $event['id'],
            $event['created_by'],
            $event['name'].' '.$event['surname'],
            $event['signed_players'],
            new EventDetails(
                $event['title'],
                $event['description'],
                $event['image'],
                $event['sport'],
                $event['number_of_players'],
                $event['location'],
                $event['date'])
        );
    }
}