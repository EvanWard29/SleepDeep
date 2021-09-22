<?php
include_once '../src/model/DbContext.php';
include_once '../src/model/sleep.php';
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';

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
            View sleep for a week
        </h1>
        <?php
        if((isset($_SESSION['user'])) && ($_SESSION['user'] != null))
        {?>
            If there is not 7 days worth of data following the inputted date, fewer days will be returned.
            <div style="position:relative;top:35px;">
                <form action="DisplaySleepTable.php" method="post">  <!-- posts start date to display sleep table page -->
                    <div class="row">
                        <div class="column">
                            Enter start date (Y-m-d):
                        </div>
                        <br>
                        <div class="column">
                            <input type="text" name="startDate"/>
                        </div>
                        <br>
                        <div class="column">
                            End date will be automatically calculated
                        </div>
                        <br>
                        <div class="column">
                            <input type="submit" name="submitDate" value="submit" />
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }
        else{
            echo "Login to View Sleeps!";
        }?>
    </div>
</div>

</body>
