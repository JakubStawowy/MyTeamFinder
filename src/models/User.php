<?php


class User{
    private $id;
    private $email;
    private $password;
    private $userDetails;

    public function __construct(int $id, string $email, string $password, UserDetails $userDetails)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->userDetails = $userDetails;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUserDetails(): UserDetails
    {
        return $this->userDetails;
    }

    public function setUserDetails(UserDetails $userDetails): void
    {
        $this->userDetails = $userDetails;
    }


}