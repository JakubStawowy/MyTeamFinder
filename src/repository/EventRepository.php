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

    public function getUserEvents(int $userId, $type = null){
        $results = [];
        switch ($type){
            case 'signed':
                $statement = $this->execute('SELECT * FROM users_in_events WHERE user_id=?', [$userId]);
                break;
            default:
                $statement = $this->execute('SELECT * FROM event_view WHERE created_by=?', [$userId]);
        }
        $events = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($events as $event){
            $results[] = $this->createEvent($event);
        }
        return $results;

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

        $query = 'SELECT * FROM event_view WHERE ';
        if($filters['spots']!=null)
            $query = $query.' number_of_players-signed_players>='.$filters['spots'].' AND';
        if($filters['location']!=null)
            $query = $query." location='".$filters['location']."'".' AND';
        if($filters['dateFrom']!=null)
            $query = $query." date>'".$filters['dateFrom']."'".' AND';
        if($filters['dateTo']!=null)
            $query = $query." date<='".$filters['dateTo']."'".' AND';
        if($filters['sport']!=null)
            $query = $query." sport='".$filters['sport']."'".' AND';
        $query = substr($query, 0 ,-4);
        $query = $query.' ORDER BY created_at';
        $statement = $this->execute($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventByTitle(string $title): array{

        $title = '%'.strtolower($title).'%';
        $statement = $this->execute('SELECT * FROM event_view WHERE LOWER(title) LIKE ? OR LOWER(description) LIKE ? ORDER BY created_at', [$title, $title]);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventDetailsId(int $eventId): int{
        $statement = $this->execute("
            SELECT event_details_id FROM event_ids WHERE event_id=?
        ", [$eventId]
        );

        return $statement->fetch()['event_details_id'];
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