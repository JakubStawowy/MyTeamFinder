<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';

class SportRepository extends DatabaseConnector
{
    public function addSport($name, $type='normal'): void {
        $this->execute('INSERT INTO sports VALUES(DEFAULT, ?, ?)', [$name, $type]);
    }

}
