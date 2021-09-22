<?php

class User
{
    private $userID;
    private $forename;
    private $surname;
    private $username;
    private $password;

    public function __construct($userID,$forename, $surname, $username, $password)
    {
        $this->userID = $userID;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->username = $username;
        $this->password = $password;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getForename()
    {
        return $this->forename;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }
}