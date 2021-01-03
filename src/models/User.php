<?php


class User{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $phone;
    private $description;
    private $country;
    private $age;
    private $image;

    public function __construct(int $id, string $name, string $surname, string $email, string $password, string $country, int $age, string $phone, string $image = 'no-image.png')
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->age = $age;
        $this->phone = $phone;
        $this->image = $image;
    }

    public function setImage(string $image): void{
        $this->image = $image;
    }

    public function getImage(){
        return $this->image;
    }
    
    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPhone(): string{
        return $this->phone;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }
}