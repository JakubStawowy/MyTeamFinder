<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/UserDetails.php';

class UserRepository extends DatabaseConnector
{
    public function getUser(string $email): ?User{

        $statement = $this->execute('
            SELECT * FROM user_view WHERE email = ?
        ', [$email]);

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
        }

        return $this->createUser($user);
    }

    public function getUserById($id = null){

        if($id == null)
            $id = $_COOKIE['id'];

        $statement = $this->execute('
            SELECT * FROM user_view WHERE id = ?
        ', [$id]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->createUser($user);
    }

    public function getUserId(User $user){
        $statement = $this->execute('SELECT id FROM public.users WHERE email=? AND password=?', [$user->getEmail(), $user->getPassword()]);
        return $statement->fetch()['id'];
    }

    public function getUserDetailsId(User $user){
        $statement = $this->execute(
          'SELECT id FROM public.user_details WHERE name=? AND surname=?',
            [$user->getUserDetails()->getName(), $user->getUserDetails()->getSurname()]
        );
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function createUser(array $user): User {
        if($user['image'] == null)
            $user['image'] = 'no-photo.png';
        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            new UserDetails(
                $user['name'],
                $user['surname'],
                $user['phone'],
                $user['description'],
                $user['country'],
                $user['age'],
                $user['image']
            )
        );
    }

}