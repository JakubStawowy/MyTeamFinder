<?php

class Event{
    private $title;
    private $description;
    private $image;
    private $sport;
    private $numberOfPlayers;
    private $location;
    private $date;
    public function __construct(string $title, string $description, string $sport, string $numberOfPlayers, string $location, string $date, string $image){

        $this->title = $title;
        $this->description = $description;
        $this->sport = $sport;
        $this->numberOfPlayers = $numberOfPlayers;
        $this->location = $location;
        $this->date = $date;
        $this->image = $image;
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getImage():string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getSport():string
    {
        return $this->sport;
    }

    public function setSport(string $sport)
    {
        $this->sport = $sport;
    }

    public function getNumberOfPlayers()
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers(int $numberOfPlayers)
    {
        $this->numberOfPlayers = $numberOfPlayers;
    }

    public function getLocation():string
    {
        return $this->location;
    }

    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function getDate():string
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }
}