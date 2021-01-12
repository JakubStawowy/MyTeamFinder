<?php


class User{
    private $id;
    private $email;
    private $password;
    private $userDetails;
    private $role;

    public function __construct(int $id, string $email, string $password, UserDetails $userDetails, string $role)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->userDetails = $userDetails;
        $this->role = $role;
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

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}