<?php

require_once 'Database.php';

class DatabaseConnector
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

    protected function getPDOConnection() {
        return $this->database->connect();
    }

    protected function executePDOConnection(PDO $connection, string $query, array $args = null) {
        $statement = $connection->prepare($query);
        $statement->execute($args);
        return $statement;
    }
}