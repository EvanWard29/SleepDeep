<?php
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';
include_once '../src/model/DbContext.php';
include_once '../src/model/event.php';
include_once '../src/model/sleep.php';
include_once '../src/model/user.php';

$success = 0;

if(!isset($db)) {
    $db = new DbContext();
}

// For when delete data button is clicked
if(isset($_POST['deleteUserData'])) {
    $userID = $_SESSION['user'];
    $success = $db->deleteUserData($userID);
    $_SESSION['userLogged'] = 0;
    $_SESSION['user'] = null;
    header('Location: index.php');
}
?>
    <head>
        <link href="../assets/css/UserSettings.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
    <div class="content">
        <div class="main">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  <!-- makes the form post to this page -->
                <br>
                <input type="submit" class="requestData" name="requestUserData" value="Request all your data"/>
                <input type="submit" class="deleteData" name="deleteUserData" value="Delete all your data" />

                <table border="1px" style="width:600px; line-height: 30px">
                    <tr>
                        <th colspan="4"><h2> User Data </h2></th>
                    </tr>
                    <t>
                        <th> Sleep ID </th>
                        <th> Sleep Start </th>
                        <th> Sleep End </th>
                        <th> User ID </th>
                    </t>

                    <?php
                    // if request data button is clicked
                    if(isset($_POST['requestUserData'])) {
                        $userID = $_SESSION['user'];
                        $sleeps = $db->Sleeps($userID);
                        foreach($sleeps as $sleep) {
                            echo "<tr>";
                            echo "<td>" . $sleep->SleepID() . "</td>";
                            echo "<td>" . $sleep->SleepStart() . "</td>";
                            echo "<td>" . $sleep->SleepEnd() . "</td>";
                            echo "<td>" . $sleep->UserID() . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
                <table border="1px" style="width:600px; line-height: 30px">
                    <t>
                        <th> Event ID </th>
                        <th> Event Date </th>
                        <th> Event Description </th>
                        <th> User ID </th>
                    </t>

                    <?php
                    // if request data button is clicked
                    if(isset($_POST['requestUserData'])) {
                        $userID = $_SESSION['user'];;
                        $events = $db->Events($userID);
                        foreach($events as $event) {
                            echo "<tr>";
                            echo "<td>" . $event->EventID() . "</td>";
                            echo "<td>" . $event->EventDate() . "</td>";
                            echo "<td>" . $event->EventDescription() . "</td>";
                            echo "<td>" . $event->UserID() . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </form>
        </div>
    </div>
    </body>

<?php
if($success > 0)
{
    echo "<br>";
    echo "Data successfully deleted!";
}
?>