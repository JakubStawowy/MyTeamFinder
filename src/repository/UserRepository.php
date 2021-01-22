<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Feedback.php';
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
        $statement = $this->execute('SELECT id FROM users WHERE email=? AND password=?', [$user->getEmail(), $user->getPassword()]);
        return $statement->fetch()['id'];
    }

    public function getUserDetailsId(User $user){
        $statement = $this->execute(
          'SELECT id FROM user_details WHERE name=? AND surname=?',
            [$user->getUserDetails()->getName(), $user->getUserDetails()->getSurname()]
        );
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }

    public function getUserFeedback(int $userId): array {

        $feedbacks = [];
        $statement = $this->execute('SELECT * FROM feedbacks WHERE about_user=?', [$userId]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $feedback):
            $addedBy = $this->getUserById($feedback['added_by']);
            $feedbacks[] = new Feedback(
                $feedback['added_by'],
                $feedback['comment'],
                $addedBy->getUserDetails()->getImage(),
                $feedback['created_at'],
                $addedBy->getUserDetails()->getName().' '.$addedBy->getUserDetails()->getSurname()
            );
        endforeach;
        return $feedbacks;
    }

    public function getUserSignedEvents(){
        $result = [];
        $statement = $this->execute('SELECT event_id FROM players_in_events WHERE user_id=?', [$_COOKIE['id']]);
        $resultSet = $statement->fetchAll(PDO::PARAM_STR);
        foreach ($resultSet as $rs){
            $result[] = $rs['event_id'];
        }
        return $result;
    }

    public function createUser(array $user): User {
        if($user['image'] == null)
            $user['image'] = 'Ndak.png';
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
            ),
            $user['role']
        );
    }
}