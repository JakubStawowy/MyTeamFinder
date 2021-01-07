<?php

class UserDetails
{
    private $name;
    private $surname;
    private $phone;
    private $description;
    private $country;
    private $age;
    private $image;

    public function __construct(string $name, string $surname, string $phone, string $description, string $country, int $age, string $image)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->description = $description;
        $this->country = $country;
        $this->age = $age;
        $this->image = $image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string$name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string$country): void
    {
        $this->country = $country;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

}