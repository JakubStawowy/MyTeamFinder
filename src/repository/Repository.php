<?php

require_once __DIR__.'/../../Database.php';

class Repository
{
    protected $database;
    public function __construct(){
        $this->database = Database::create();
    }
    private function prepareStatement(string $query){
        return $this->database->connect()->prepare($query);
    }
    protected function execute(string $query, array $args = null): PDOStatement{
        $statement = $this->prepareStatement($query);
        $statement->execute($args);
        return $statement;
    }
}