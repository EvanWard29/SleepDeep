<?php
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';
include_once '../src/model/DbContext.php';
include_once '../src/model/sleep.php';

if(!isset($db))
{
    $db = new DbContext();
}
?>
<head>
    <link href="../assets/css/index.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="content">
        <div class="main">
            <h3>
                Display sleep
            </h3>


            On the day: <?php echo "<b>" . ($_POST["SleepDate"]) . "</b>"; echo "<br>"; //prints the date the user chose ?>

            You slept from
            <?php
            $userID = $_SESSION['user'];
            $sleep = $db->Sleeps($userID);
            $date = "";
            $sleepStart = "";
            $sleepEnd = "";
            $sleepQuality = "";
            $mood = "";

            if($sleep)
            {
                foreach($sleep as $sleepDate) //finds the times for the date the user chose
                {
                    $date = $sleepDate->sleepStart();
                    $date = substr($date, 0, 10);

                    if($date == ($_POST["SleepDate"])){
                        $sleepStart = substr($sleepDate->SleepStart(), 10); //crops the datetime variables to just display the times
                        $sleepEnd = substr($sleepDate->SleepEnd(), 10);
                        $sleepQuality = $sleepDate->SleepQuality();
                        $mood = $sleepDate->Mood();

                        echo "<b>" . $sleepStart . "</b> until <b>" . $sleepEnd . "</b>";
                    }
                }
                echo '<br>';
                echo "You Rated the Quality of Your Sleep as a: <b>" . $sleepQuality . "</b><br>";
                echo "Your Mood After Sleeping Was: <b>" . $mood . "</b><br>";

            }
            ?>

        </div>
    </div>
</body>
