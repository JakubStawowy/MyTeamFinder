<?php


class EventDetails
{
    private $title;
    private $description;
    private $image;
    private $sport;
    private $numberOfPlayers;
    private $location;
    private $date;

    public function __construct($title, $description, $image, $sport, $numberOfPlayers, $location, $date)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->sport = $sport;
        $this->numberOfPlayers = $numberOfPlayers;
        $this->location = $location;
        $this->date = $date;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getSport()
    {
        return $this->sport;
    }

    public function setSport($sport): void
    {
        $this->sport = $sport;
    }

    public function getNumberOfPlayers()
    {
        return $this->numberOfPlayers;
    }

    public function setNumberOfPlayers($numberOfPlayers): void
    {
        $this->numberOfPlayers = $numberOfPlayers;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setLocation($location): void
    {
        $this->location = $location;
    }

    public function getDate()
    {
        return substr($this->date, 0, 16);
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }


}