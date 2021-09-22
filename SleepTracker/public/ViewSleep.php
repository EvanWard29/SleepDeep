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
        <h1>
            View sleep
        </h1>

        <div style="position:relative;top:35px;">
            <form action="DisplaySleep.php" method="post">
                <div class="row" style="position:relative;top:10px;">
                    <div class="column">
                        <?php
                        if((isset($_SESSION['user'])) && ($_SESSION['user'] != null))
                        {?>
                            <select class="custom-select form-control" name="SleepDate">
                                <option value="">Select Date</option>
                            <?php
                                $optionString = "";

                                $userID = $_SESSION['user'];
                                $sleep = $db->Sleeps($userID);
                                $sleepStart = "";

                                if($sleep) //creates a dropdown box of all the dates with sleep data
                                {
                                    foreach($sleep as $sleepDate)
                                    {
                                        $sleepStart = substr($sleepDate->sleepStart(), 0, 10);

                                        $optionString .= "<option value=" .$sleepDate->sleepStart().">".$sleepStart."</option>";
                                    }
                                }
                                echo $optionString;
                                ?>
                            </select>
                            <div class="column" style="position:relative;top:35px;">
                                <input type="submit" name="sleepSearch" value="submit" />
                            </div>
                        <?php
                        }
                        else{
                            ?>
                            Login To View Sleeps!
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

