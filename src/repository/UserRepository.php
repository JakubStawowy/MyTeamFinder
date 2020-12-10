<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User{

        //getting user
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE email = :email
        ');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //getting user details
        $statement = $this->getFromDatabase('SELECT * FROM public.user_details WHERE id=?');
        $statement->execute([$user['user_details_id']]);
        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            throw new Exception("User with this email doesn't exists");
        }
        return new User(
            $user['id'],
            $userDetails['name'],
            $userDetails['surname'],
            $user['email'],
            $user['password']
        );
    }
    public function logUser($userId){
        try{
            $statement = $this->database->connect()->prepare("
            INSERT INTO logs VALUES(DEFAULT, :user_id, DEFAULT);
            ");
            $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $statement->execute();
        }catch (PDOException $e){
            die("PDO Error: ".$e->getMessage());
        }
    }
}