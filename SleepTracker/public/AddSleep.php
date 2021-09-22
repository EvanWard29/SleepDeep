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

if(isset($_POST['submitSleepData']))
{
    $sleepStart = "";
    $sleepEnd = "";
    $sleepQuality = "";
    $mood = "";

    if((isset($_SESSION['user'])) && ($_SESSION['user'] != null))
    {
        function validateDate($date){        //tests to see if the user input is correct date variable, returns true or false
            $format = 'Y-m-d';
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        $startDate = $_POST['Date'];
        $startTime = $_POST['sleepStart'];
        $endTime = $_POST['sleepEnd'];
        $mood = $_POST['mood'];

        function validateMood($mood){      //makes sure the mood input does not contain anything dangerous (special characters or numbers)
            $pattern = ('/[^A-Za-z\-]/');
            return preg_replace($pattern, '', $mood);
        }

        $mood = validateMood($mood);

        if (!validateDate($startDate) || strtotime($startTime) == false || strtotime($endTime) == false){   //if any of the user inputs are not correct, displays a popup, then reloads the page
            ?>
            <script>
                alert("Incorrect user input received!");
                window.location.href = "AddSleep.php";
            </script>
            <?php
        }

        $userID = $_SESSION['user']; //Get Current User ID From $_SESSION['user']
        $morningDate =($_POST['Date'] . " " . $_POST['sleepEnd']); //makes a datetime variable out of the separate date and time


        if(substr($_POST['sleepStart'], 0, 2) > 6) //makes the sleep end date correct if the user slept through midnight
        {
            $morningDate = date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($morningDate))));
        }

        $sleepStart = $_POST['Date'] . " " . $_POST['sleepStart']; //makes a datetime variable out of the separate date and time
        $sleepEnd = $morningDate;
        $sleepQuality = $_POST['sleepQuality'];

        $newSleepData = new sleep(1, $sleepStart, $sleepEnd, $sleepQuality, $mood, $userID);
        $success = $db->addSleepData($newSleepData); //records whether or not the data was stored correctly
    }
    else
    {
        echo "<script> alert('Login to Add Sleeps') </script>";
    }
}

?>
<head>
    <link href="../assets/css/index.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="content">
    <div class="main">
        <h1>
            Add sleep
        </h1>

        <div style="position:relative;top:35px;">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  <!-- makes the form post to this page -->
                <div class="row" style="position:relative;top:35px;">
                    <div class="column">
                        Enter Date (Y-m-d):
                    </div>
                    <div class="column">
                        <input type="text" name="Date" required/>
                    </div>
                    <div class="column">
                        Enter Sleep Start Time (hours:minutes):
                    </div>
                    <div class="column">
                        <input type="text" name="sleepStart" required/>
                    </div>
                    <div class="column">
                        Enter Sleep End Time (hours:minutes):
                    </div>
                    <div class="column">
                        <input type="text" name="sleepEnd" required/>
                    </div>
                    <div style="padding-bottom: 5px" class="column">
                        Quality of Sleep:
                    </div>
                    <div class="column">
                        <select style="display:inline" id="sleepQuality" name="sleepQuality">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div style="padding-top:5px" class="column">
                        Enter Current Mood:
                    </div>
                    <div class="column">
                        <input type="text" name="mood" required/>
                    </div>
                    <div class="column" style="position:relative;top:35px;">
                        <input type="submit" name="submitSleepData" value="Submit Sleep" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<?php
echo $_SESSION['user'];

if($success > 0)
{
    echo "<script> alert('Sleep Successfully Added!') </script>";
}
?>
