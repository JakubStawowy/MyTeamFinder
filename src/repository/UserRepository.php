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
        $statement = $this->prepareStatement('SELECT * FROM public.user_details WHERE id=?');
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
            $user['password'],
            $userDetails['country'],
            $userDetails['age'],
            $userDetails['phone']
        );
    }
    public function getUserById(){

        //getting user
        $statement = $this->database->connect()->prepare('
            SELECT * FROM public.users WHERE id = :id
        ');
        $statement->bindParam(':id', $_COOKIE['id'], PDO::PARAM_INT);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //getting user details
        $statement = $this->prepareStatement('SELECT * FROM public.user_details WHERE id=?');
        $statement->execute([$user['user_details_id']]);
        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);

        $newUser = new User(
            $user['id'],
            $userDetails['name'],
            $userDetails['surname'],
            $user['email'],
            $user['password'],
            $userDetails['country'],
            $userDetails['age'],
            $userDetails['phone']
        );
        $newUser->setDescription($userDetails['description']);

        return $newUser;
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
    public function registerUser(User $user){
        try{
            $statement = $this->prepareStatement("INSERT INTO public.user_details VALUES(DEFAULT, ?, ?, '', ?, ?, ?)");
            $statement->execute([$user->getName(), $user->getSurname(), $user->getPhone(), $user->getCountry(), $user->getAge()]);

            $statement = $this->prepareStatement('INSERT INTO public.users VALUES(DEFAULT, ?, ?, ?, DEFAULT)');
            $statement->execute([$this->getUserDetailsId($user), $user->getEmail(), $user->getPassword()]);

            $user->setId($this->getUserId($user));
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    private function getUserId(User $user){
        $statement = $this->prepareStatement('SELECT id FROM public.users WHERE email=? AND password=?');
        $statement->execute([$user->getEmail(), $user->getPassword()]);
        return $statement->fetch()['id'];
    }
    private function getUserDetailsId(User $user){
        $statement = $this->prepareStatement(
          'SELECT id FROM public.user_details WHERE name=? AND surname=?'
        );
        $statement->execute([$user->getName(), $user->getSurname()]);
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }
    public function getUserNameSurname(int $id): string{
        $statement = $this->prepareStatement('SELECT user_details_id FROM public.users WHERE id=?');
        $statement->execute([$id]);
        $userDetailsId = $statement->fetch(PDO::FETCH_ASSOC)['user_details_id'];
        $statement = $this->prepareStatement('SELECT name, surname FROM user_details WHERE id=?');
        $statement->execute([$userDetailsId]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['name'].' '.$result['surname'];
    }
}