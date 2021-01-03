<?php

require_once 'Repository.php';
class SportRepository extends Repository
{
    public function getSports($type='normal'): array{
        $result = [];
        $statement = $this->execute("SELECT name FROM sports WHERE type=?", [$type]);
        $normalSports = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($normalSports as $normalSport){
            $result[] = $normalSport['name'];
        }
        return $result;
    }

}
