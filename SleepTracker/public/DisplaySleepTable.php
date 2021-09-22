<?php
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';
include_once '../src/model/DbContext.php';
include_once '../src/model/sleep.php';
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';

if(!isset($db))
{
    $db = new DbContext();
}

function validateDate($date){        //tests to see if the user input is correct date variable, returns true or false
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$startDate = $_POST['startDate'];

if (!validateDate($startDate)){   //if  the user input is not correct, displays a popup, then takes user back a page
    ?>
    <script>
        alert("Incorrect user input received!");
        window.location.href = "WeeklySleep.php";
    </script>
    <?php
}
?>
<head>
    <link href="../assets/css/sleeptable.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div class="content">
    <div class="main">
        <h1>
            Sleep for a week
        </h1>
        <br>
        <table>
            <?php
            $userID = $_SESSION['user']; //Get Current User ID From $_SESSION['user']
            $weekSleep = $db->getWeeksSleep($_POST['startDate'], $userID);
            $date = "";
            $sleepStart = "";
            $sleepEnd = "";
            $sleepQuality = "";
            $mood = "";
            $weeklySleepTime = 0;
            $goodSleepCounter = 0;
            $dayCounter = 0;

            if($weekSleep)
            {
                ?>
                <td>Date: </td>
                <td>Sleep start time: </td>
                <td>Sleep end time: </td>
                <td>Sleep duration: </td>
                <td>Sleep Quality:</td>
                <td>Mood:</td>
                <?php
                foreach($weekSleep as $sleepDate)
                {
                    ?>
                    <tr>
                        <?php
                        $date = $sleepDate['sleepStart'];
                        $date = substr($date, 0, 10);
                        ?>
                        <td> <?php echo $date ?> </td>
                        <?php

                        $sleepStart = substr($sleepDate['sleepStart'], 10); //crops the datetime variables to just display the times
                        $sleepEnd = substr($sleepDate['sleepEnd'], 10);
                        $sleepStart = strtotime($sleepStart);
                        $sleepEnd = strtotime($sleepEnd);
                        $sleepTime = $sleepEnd - $sleepStart;
                        $sleepQuality = $sleepDate['sleepQuality'];
                        $mood = $sleepDate['mood'];
                        ?>
                        <td> <?php echo date('H:i:s', $sleepStart) ?> </td>
                        <td> <?php echo date('H:i:s', $sleepEnd) ?> </td>
                        <td> <?php echo date('H.i', $sleepTime) ?> </td>
                        <td> <?php echo $sleepQuality ?></td>
                        <td> <?php echo $mood ?></td>
                        <?php
                        ?>
                    </tr>
                       <?php
                        $weeklySleepTime = $weeklySleepTime + date('H.i', $sleepTime);       //calculate the total sleep time

                         if (date('H.i', $sleepTime) > 8)
                         {
                             $goodSleepCounter = $goodSleepCounter + 1;
                         }

                         $dayCounter = $dayCounter + 1;
                       ?>
            <?php
        }
    } else {
        echo "Could not find data for that date";
    }
    ?>
</table>

<h3>
<?php
if($weekSleep)
{
$averageSleepTime = (round( $weeklySleepTime / $dayCounter, 2));
?>
    <br> <?php echo "You slept more than 8 hours " .  $goodSleepCounter . " days in the week. "; ?>
    <br> <?php echo "Total sleep time for the week is " . $weeklySleepTime . " hours. "; ?>
    <br> <?php echo "Your average sleep time of the week is " . $averageSleepTime . " hours. ";
}
?>
</h3>
    </div>
</div>
</body>

