<?php

class Event{

    private $id;
    private $addedById;
    private $addedByNameSurname;
    private $signedPlayers;
    private $eventDetails;

    public function __construct($id, $addedById, $addedByNameSurname, $signedPlayers, $eventDetails)
    {
        $this->id = $id;
        $this->addedById = $addedById;
        $this->addedByNameSurname = $addedByNameSurname;
        $this->signedPlayers = $signedPlayers;
        $this->eventDetails = $eventDetails;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getAddedById()
    {
        return $this->addedById;
    }

    public function setAddedById($addedById): void
    {
        $this->addedById = $addedById;
    }

    public function getAddedByNameSurname()
    {
        return $this->addedByNameSurname;
    }

    public function setAddedByNameSurname($addedByNameSurname): void
    {
        $this->addedByNameSurname = $addedByNameSurname;
    }

    public function getSignedPlayers()
    {
        return $this->signedPlayers;
    }

    public function setSignedPlayers($signedPlayers): void
    {
        $this->signedPlayers = $signedPlayers;
    }

    public function getEventDetails()
    {
        return $this->eventDetails;
    }

    public function setEventDetails($eventDetails): void
    {
        $this->eventDetails = $eventDetails;
    }
}