<?php

class Sleep
{
    private $sleepID;
    private $sleepStart;
    private $sleepEnd;
    private $sleepQuality;
    private $mood;
    private $userID;

    public function __construct($SleepID, $SleepStart, $SleepEnd,$SleepQuality, $Mood, $UserID)
    {
        $this->sleepID = $SleepID;
        $this->sleepStart = $SleepStart;
        $this->sleepEnd = $SleepEnd;
        $this->sleepQuality = $SleepQuality;
        $this->mood = $Mood;
        $this->userID = $UserID;
    }

    public function SleepID()
    {
        return $this->sleepID;
    }
    public function SleepStart()
    {
        return $this->sleepStart;
    }
    public function SleepEnd()
    {
        return $this->sleepEnd;
    }
    public function SleepQuality()
    {
        return $this->sleepQuality;
    }
    public function Mood()
    {
        return $this->mood;
    }
    public function UserID()
    {
        return $this->userID;
    }

}