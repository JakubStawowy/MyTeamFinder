<?php

require_once __DIR__.'/../templates/DatabaseConnector.php';

class UserManager extends DatabaseConnector
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
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
                [$user->getUserDetails()->getName(),
                    $user->getUserDetails()->getSurname(),
                    $user->getUserDetails()->getPhone(),
                    $user->getUserDetails()->getCountry(),
                    $user->getUserDetails()->getAge()]);
            $this->execute('INSERT INTO public.users VALUES(DEFAULT, ?, ?, ?, DEFAULT)', [$this->getUserDetailsId($user), $user->getEmail(), $user->getPassword()]);
            $user->setId($this->userRepository->getUserId($user));
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function editUser(User $user){
        $this->execute('UPDATE users SET password=? WHERE id=?', [$user->getPassword(), $user->getId()]);
        $statement = $this->execute('SELECT user_details_id FROM users WHERE id=?', [$user->getId()]);
        $user_details_id = $statement->fetch()['user_details_id'];
        $this->execute('UPDATE user_details SET name=?, surname=?, description=?, phone=?, country=?, age=?, image=? WHERE id=?', [
            $user->getUserDetails()->getName(),
            $user->getUserDetails()->getSurname(),
            $user->getUserDetails()->getDescription(),
            $user->getUserDetails()->getPhone(),
            $user->getUserDetails()->getCountry(),
            $user->getUserDetails()->getAge(),
            $user->getUserDetails()->getImage(),
            $user_details_id
        ]);
    }
}