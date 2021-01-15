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
        $PDOConnection = $this->getPDOConnection();
        try{
            $this->executePDOConnection($PDOConnection, "INSERT INTO public.user_details VALUES(DEFAULT, ?, ?, '', ?, ?, ?)",
                [$user->getUserDetails()->getName(),
                    $user->getUserDetails()->getSurname(),
                    $user->getUserDetails()->getPhone(),
                    $user->getUserDetails()->getCountry(),
                    $user->getUserDetails()->getAge()]);
            $user_details_id = $PDOConnection->lastInsertId();
//            $this->userRepository->getUserDetailsId($user)
            $this->executePDOConnection($PDOConnection, 'INSERT INTO public.users VALUES(DEFAULT, ?, ?, ?, DEFAULT)', [$user_details_id, $user->getEmail(), $user->getPassword()]);
            $user->setId($this->userRepository->getUserId($user));
            return true;
        }
        catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
            return false;
        }
    }

    public function editUser(User $user){

        $PDOConnection = $this->getPDOConnection();

        try{
            $this->executePDOConnection($PDOConnection, 'UPDATE users SET password=? WHERE id=?', [$user->getPassword(), $user->getId()]);
            $statement = $this->executePDOConnection($PDOConnection, 'SELECT user_details_id FROM users WHERE id=?', [$user->getId()]);
            $user_details_id = $statement->fetch()['user_details_id'];
            $this->executePDOConnection($PDOConnection, 'UPDATE user_details SET name=?, surname=?, description=?, phone=?, country=?, age=?, image=? WHERE id=?', [
                $user->getUserDetails()->getName(),
                $user->getUserDetails()->getSurname(),
                $user->getUserDetails()->getDescription(),
                $user->getUserDetails()->getPhone(),
                $user->getUserDetails()->getCountry(),
                $user->getUserDetails()->getAge(),
                $user->getUserDetails()->getImage(),
                $user_details_id
            ]);
        } catch (Exception $e){
            echo $e->getMessage();
            if($PDOConnection->inTransaction())
                $PDOConnection->rollBack();
        }
    }

    public function addComment(string $comment, int $userId): void {
        $this->execute('INSERT INTO feedbacks VALUES(DEFAULT, ?, ?, 5, DEFAULT, ?)', [$_COOKIE['id'], $comment, $userId]);
    }

    public function makeUserAdmin($userId){
        $this->execute('UPDATE users SET role=2 WHERE id=?', [$userId]);
    }
}