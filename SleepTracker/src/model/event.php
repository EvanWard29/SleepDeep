<?php

class Event
{

    private $eventID;
    private $eventDate;
    private $eventDescription;
    private $userID;

    public function __construct($EventID, $EventDate, $EventDescription, $UserID)
    {
        $this->eventID = $EventID;
        $this->eventDate = $EventDate;
        $this->eventDescription = $EventDescription;
        $this->userID = $UserID;
    }

    public function EventID()
    {
        return $this->eventID;
    }

    public function EventDate()
    {
        return $this->eventDate;
    }

    public function EventDescription()
    {
        return $this->eventDescription;
    }

    public function UserID()
    {
        return $this->userID;
    }

}