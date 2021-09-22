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
$userID = $_SESSION['user'];
?>

<head>
    <link href="../assets/css/sleeptable.css" type="text/css" rel="stylesheet" />
</head>


<div class="content">
    <div class="main">
        <head>
            <link href="../assets/css/sleeptable.css" type="text/css" rel="stylesheet" />
        </head>

        <h1>
            Display the day when you slept more than 8h.
        </h1>

        <body>
        <table>
            <?php
            $sleep = $db->Sleeps($userID);
            $date = "";
            $sleepStart = "";
            $sleepEnd = "";

            if($sleep) {
                ?>
                <td>Date:</td>
                <td>Sleep start time:</td>
                <td>Sleep end time:</td>
                <td>Sleep duration:</td>
                <td>Sleep Quality:</td>
                <td>Mood:</td>
                <?php
                foreach ($sleep as $sleepDate) {
                    ?>
                    <tr>
                        <?php
                        $date = $sleepDate->sleepStart();
                        $date = substr($date, 0, 10);
                        $sleepStart = substr($sleepDate->sleepStart(), 10); //crops the datetime variables to just display the times
                        $sleepEnd = substr($sleepDate->sleepEnd(), 10);
                        $sleepStart = strtotime($sleepStart);
                        $sleepEnd = strtotime($sleepEnd);
                        $sleepTime = $sleepEnd - $sleepStart;
                        $sleepQuality = $sleepDate->sleepQuality();
                        $mood = $sleepDate->mood();

                        if (date('H.i', $sleepTime) > 8) {
                            ?>
                            <td> <?php echo $date ?> </td>
                            <td> <?php echo date('H:i:s', $sleepStart) ?> </td>
                            <td> <?php echo date('H:i:s', $sleepEnd) ?> </td>
                            <td> <?php echo date('H.i', $sleepTime) ?> </td>
                            <td> <?php echo $sleepQuality ?></td>
                            <td> <?php echo $mood ?></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
            else {
                echo "Could not find data for that data";
            }
            ?>
        </table>
        </body>
    </div>
</div>