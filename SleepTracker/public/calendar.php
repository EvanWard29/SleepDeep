<?php
include '../src/model/calendar.php';
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';

$calendar = new calendar();
$DB = new DbContext();
$userID = $_SESSION['user'];

//Build Calendar
echo $calendar->show();
//Get all Events of current user from database
$results = $DB->Events($userID);
?>

<html>
    <head>
        <!-- Style Calendar -->
        <link href="../assets/css/calendar.css" type="text/css" rel="stylesheet" />
        <script src="../assets/js/MobileRedirect.js"></script>
    </head>
    <body>
        <div class="content">
            <div class="main">
            <!-- Build Form to add new events -->
            <h4>Enter new event/View selected event:</h4>
            <form class="w3-container w3-card-4" method="post" action="<?php echo basename($_SERVER['PHP_SELF'])?>">
                <p>
                    <label><b>Date:</b>
                        <input class="w3-input w3-border" id="date" name="date" type="text" readonly>
                    </label>
                </p>
                <p>
                    <label><b>Event:</b>
                        <input class="w3-input w3-border" id="event" name="event" type="text">
                    </label>
                </p>
                <br>
                <input type="submit" name="saveEvent" class="btn btn-success" value="Save Event">
            </form>

        <script>
            //Show Events when a date is selected
            $(document).ready(function() {

                $('li').click(function() {
                    var id = $(this).attr('id');
                    $("#date").val(id);
                    description(id); //Get event description if an event is saved in database
                });
            });
        </script>

            </div>
        </div>
    </body>
</html>

<?php
if(isset($_POST['saveEvent']))
{
    //Save new event to database
    $date = $_POST['date'];
    $event = $_POST['event'];

    $userID = $_SESSION['user'];
    $newEvent = new Event(null, $date, $event, $userID);
    $DB->saveEvent($newEvent);
}

?>
<script>
    //Array for adding user events to
    var events = [];
</script>
<?php
foreach($results as $row)
{
    ?>
    <script>
        var eventDate = "<?php echo $eventDate = $row->EventDate()?>";
        document.getElementById(eventDate).style.color = "blue";

        var eventDescription = "<?php echo $eventDescription = $row->EventDescription() ?>";
        var event = {date: eventDate, description: eventDescription};
        events.push(event);
    </script>
    <?php
}
?>
<script>
    function description(id)
    {
        for (i = 0; i < events.length; i++)
        {
            if(id === events[i].date)
            {
                //If an event matches the selected date, show the event
                $("#event").val(events[i].description);
                break;
            }
            else
            {
                //Otherwise leave field empty
                $("#event").val("");
            }
        }
    }
</script>







