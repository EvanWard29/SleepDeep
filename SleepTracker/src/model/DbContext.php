<?php
include_once 'event.php';
include_once 'sleep.php';
include_once 'user.php';

class DbContext
{
    private $db_server = 'proj-mysql.uopnet.plymouth.ac.uk';
    private $dbUser = 'PRCO204_GeekSquad';
    private $dbPassword = 'WiWkpuKWbaJpR2Je';
    private $dbDatabase = 'PRCO204_GeekSquad';

    private $dataSourceName;
    private $connection;

    public function __construct(PDO $connection = null)
    {
        $this->connection = $connection;
        try
        {
            if ($this->connection === null) {
                $this->dataSourceName = 'mysql:dbname=' . $this->dbDatabase . ';host=' . $this->db_server;
                $this->connection = new PDO($this->dataSourceName, $this->dbUser, $this->dbPassword);
                $this->connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
        }
        catch (PDOException $err)
        {
            echo 'Connection failed: ', $err->getMessage();
        }
    }

    public function Sleeps($userID)
    {

        $sql = "SELECT * FROM `Sleeps` WHERE userID = ?";


        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $sleeps = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $sleep = new Sleep($row['sleepID'], $row['sleepStart'], $row['sleepEnd'], $row['sleepQuality'], $row['mood'], $row['userID']);
                $sleeps[] = $sleep;
            }
        }
        return $sleeps;
    }



    public function SleepsUserID($userID)
    {
        $sql = "SELECT * FROM `sleeps` WHERE userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $sleeps = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {

                $sleep = new Sleep($row['sleepID'], $row['sleepStart'], $row['sleepEnd'], $row['sleepQuality'], $row['mood'], $row['userID']);
                $sleeps[] = $sleep;
            }
        }
        return $sleeps;
    }


    public function Events($userID)
    {
        $sql = "SELECT * FROM CalendarEvents WHERE userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $events = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $event = new Event($row['eventID'], $row['eventDate'], $row['eventDescription'], $row['userID']);
                $events[] = $event;
            }
        }
        return $events;
    }

    public function EventsUserID($userID)
    {
        $sql = "SELECT * FROM `calendarevents` WHERE userID = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$userID]);
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $events = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $event = new Event($row['eventID'], $row['eventDate'], $row['eventDescription'], $row['userID']);
                $events[] = $event;
            }
        }
        return $events;
    }

    public function saveEvent($event)
    {
        $eventDate = $event->EventDate();
        $eventDescription = $event->EventDescription();
        $userID = $event->UserID();

        $sql = "CALL AddEvent(:p_EventDate, :p_EventDescription, :p_UserID)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':p_EventDate', $eventDate, PDO::PARAM_STR);
        $statement->bindParam(':p_EventDescription', $eventDescription, PDO::PARAM_STR);
        $statement->bindParam(':p_UserID', $userID, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getEventID()
    {
        $sql = "CALL GetEventID()";

        $statement = $this->connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchColumn();

        return $result;
    }

    public function Users()
    {
        $sql = "SELECT * FROM `users`";

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $resultSet = $statement->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        if($resultSet)
        {
            foreach($resultSet as $row)
            {
                $user = new User($row['userID'], $row['forename'], $row['surname'], $row['username'], null);
                $users[] = $user;
            }
        }
        return $users;
    }


    public function deleteUserData($userID)
    {
        $sql = "CALL GDPR_DeleteAll(:userID)";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':userID', $userID, PDO::PARAM_INT);
        $return = $statement->execute();
        return $return;
    }


    public function addSleepData($newSleepData)
    {
        $sql = "call AddSleepData(:newSleepStart, :newSleepEnd, :newSleepQuality, :newMood, :UserID)";

        $sleepStart = $newSleepData->SleepStart();
        $sleepEnd = $newSleepData->SleepEnd();
        $sleepQuality = $newSleepData->SleepQuality();
        $mood = $newSleepData->Mood();
        $userID = $newSleepData->UserID();

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':newSleepStart', $sleepStart, PDO::PARAM_STR);
        $statement->bindParam(':newSleepEnd', $sleepEnd, PDO::PARAM_STR);
        $statement->bindParam(':newSleepQuality', $sleepQuality, PDO::PARAM_STR);
        $statement->bindParam(':newMood', $mood, PDO::PARAM_STR);
        $statement->bindParam(':UserID', $userID, PDO::PARAM_INT);

        $return = $statement->execute();

        return $return;
    }


    public function getWeeksSleep($weekStart, $userID)
    {
        $sql = "call GetWeeklyData(:startDate, :endDate, :inUserID)";

        $weekEnd = date('Y-m-d', date(strtotime("+7 day", strtotime($weekStart))));

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':startDate', $weekStart, PDO::PARAM_STR);
        $statement->bindParam(':endDate', $weekEnd, PDO::PARAM_STR);
        $statement->bindParam(':inUserID', $userID, PDO::PARAM_STR);

        $statement->execute();
        $return = $statement->fetchAll();

        return $return;
    }


    public function userLogin($username)
    {
        $sql = "CALL UserLoginDetails(:p_Username)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':p_Username', $username, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $userDetails = null;

        if($result)
        {
            foreach($result as $row)
            {
                $user = new User($row['userID'], $row['forename'], $row['surname'],$row['username'], $row['userPassword']);
                $userDetails = $user;
            }
        }

        return $userDetails;
    }

    public function checkUsername($username)
    {
        $sql = "CALL CheckUsername(:p_Username)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':p_Username', $username, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchColumn();

        return $result;
    }

    public function addUser($user)
    {
        $forename = $user->getForename();
        $surname = $user->getSurname();
        $username = $user->getUsername();
        $password = $user->getPassword();

        $sql = "CALL AddUser(:p_Forename, :p_Surname, :p_Username, :p_Password)";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(':p_Forename', $forename, PDO::PARAM_STR);
        $statement->bindParam(':p_Surname', $surname, PDO::PARAM_STR);
        $statement->bindParam(':p_Username', $username, PDO::PARAM_STR);
        $statement->bindParam(':p_Password', $password, PDO::PARAM_STR);

        $statement->execute();
    }

    public function getGraphSleep($startDate, $endDate, $userID)
    {
        $sql = "call GetWeeklyData(:startDate, :endDate, :inUserID)";

        $statement = $this->connection->prepare($sql);

        $statement->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $statement->bindParam(':endDate', $endDate, PDO::PARAM_STR);
        $statement->bindParam(':inUserID', $userID, PDO::PARAM_STR);

        $statement->execute();
        $return = $statement->fetchAll();

        return $return;
    }
}