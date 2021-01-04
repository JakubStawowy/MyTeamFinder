<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';
class UserRepository extends Repository
{
    public function getUser(string $email): ?User{

        //getting user
        $statement = $this->execute('
            SELECT * FROM public.users WHERE email = ?
        ', [$email]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //getting user details
        $statement = $this->execute('SELECT * FROM public.user_details WHERE id=?', [$user['user_details_id']]);
        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);

        if($user == false){
            return null;
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
        $statement = $this->execute('
            SELECT * FROM public.users WHERE id = ?
        ', [$_COOKIE['id']]);
//        $statement = $this->execute('
//            SELECT * FROM public.users WHERE id = 4
//        ');
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //getting user details
//        $statement = $this->execute('SELECT * FROM public.user_details WHERE id=5');
        $statement = $this->execute('SELECT * FROM public.user_details WHERE id=?', [$user['user_details_id']]);
        $userDetails = $statement->fetch(PDO::FETCH_ASSOC);
        $newUser = new User(
            $user['id'],
            $userDetails['name'],
            $userDetails['surname'],
            $user['email'],
            $user['password'],
            $userDetails['country'],
            $userDetails['age'],
            $userDetails['phone'],
            $userDetails['image']
        );
        $newUser->setDescription($userDetails['description']);
        return $newUser;
    }
    public function logUser($userId){
        try{
            $this->execute("INSERT INTO logs VALUES(DEFAULT, ?, DEFAULT);", [$userId]);
        }catch (PDOException $e){
            die("PDO Error: ".$e->getMessage());
        }
    }
    public function registerUser(User $user){
        try{
            $this->execute("INSERT INTO public.user_details VALUES(DEFAULT, ?, ?, '', ?, ?, ?)",
                [$user->getName(),
                $user->getSurname(),
                $user->getPhone(),
                $user->getCountry(),
                $user->getAge()]);
            $this->execute('INSERT INTO public.users VALUES(DEFAULT, ?, ?, ?, DEFAULT)', [$this->getUserDetailsId($user), $user->getEmail(), $user->getPassword()]);
            $user->setId($this->getUserId($user));
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    private function getUserId(User $user){
        $statement = $this->execute('SELECT id FROM public.users WHERE email=? AND password=?', [$user->getEmail(), $user->getPassword()]);
        return $statement->fetch()['id'];
    }
    private function getUserDetailsId(User $user){
        $statement = $this->execute(
          'SELECT id FROM public.user_details WHERE name=? AND surname=?',
            [$user->getName(), $user->getSurname()]
        );
        return $statement->fetch(PDO::FETCH_ASSOC)['id'];
    }
    public function editUser(User $user){
        $this->execute('UPDATE users SET password=? WHERE id=?', [$user->getPassword(), $user->getId()]);
        $statement = $this->execute('SELECT user_details_id FROM users WHERE id=?', [$user->getId()]);
        $user_details_id = $statement->fetch()['user_details_id'];
        $this->execute('UPDATE user_details SET name=?, surname=?, description=?, phone=?, country=?, age=?, image=? WHERE id=?', [
            $user->getName(),
            $user->getSurname(),
            $user->getDescription(),
            $user->getPhone(),
            $user->getCountry(),
            $user->getAge(),
            $user->getImage(),
            $user_details_id
        ]);
    }
}