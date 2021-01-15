<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';

class SportRepository extends DatabaseConnector
{
    public function getSports($type='normal'): array{
        $result = [];
//        $statement = $this->execute("SELECT name FROM sports WHERE type=?", [$type]);
//        $normalSports = $statement->fetchAll(PDO::FETCH_ASSOC);
//        foreach ($normalSports as $normalSport){
//            $result[] = $normalSport['name'];
//        }
        return $result;
    }

    public function addSport($name, $type='normal'): void {
        $this->execute('INSERT INTO sports VALUES(DEFAULT, ?, ?)', [$name, $type]);
    }

}
