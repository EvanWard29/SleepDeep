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

function validateDate($date){        //tests to see if the user input is correct date variable, returns true or false
    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];

if (!validateDate($startDate) || !validateDate($endDate)){   //if either of the user inputs are not correct, displays a popup, then takes user back a page
    ?>
    <script>
        alert("Incorrect user input received!");
        window.location.href = "GraphSleep.php";
    </script>
    <?php
}

$userID = $_SESSION['user']; //Get Current User ID From $_SESSION['user']

$weekSleep = $db->getGraphSleep($startDate, $endDate, $userID);
?>

<script>
    var xData = [];
    var yData = [];
</script>

<?php


function convert($sleepTime) {                           //converts data from hours:minutes format to hours decimal format
    $hours = substr($sleepTime, 0, 2 );
    $minutes = substr($sleepTime, 3);
    return $hours + ($minutes / 60);
}

foreach ($weekSleep as $sleepData){
    $sleepDate = substr($sleepData['sleepStart'], 0, 10); //crops the first sleep datetime to just the date

    $sleepStart = substr($sleepData['sleepStart'], 10); //crops the datetime variables to just display the times
    $sleepEnd = substr($sleepData['sleepEnd'], 10);
    $sleepStart = strtotime($sleepStart);
    $sleepEnd = strtotime($sleepEnd);
    $sleepTime = $sleepEnd - $sleepStart;                      //gets sleeps time
    $sleepTime = date('H.i', $sleepTime);

    $sleepTimeDecimal = convert($sleepTime);

    ?>
    <script>
        xData.push(<?php echo json_encode($sleepDate);?>);         //puts the php variables into two arrays for x and y data
        yData.push(<?php echo json_encode($sleepTimeDecimal);?>);
    </script>
    <?php
}
?>


<body>
<div class="content">
    <div class="main">
        <h1>
            Sleep graph
        </h1>
        <?php
        if($weekSleep){
            ?>
            <canvas id="graph" width="1000" height="600" style="position:relative;left:50px;"></canvas>
            <?php
        } else {
            echo "Could not find data for that date";
        }
        ?>
    </div>
</div>
</body>


<script>
    var graph;
    var xPadding = 30;
    var yPadding = 30;

    function swapData(array, data1, data2){     //function to swap the data positions in the array
        var temp = array[data1];
        array[data1] = array[data2];
        array[data2] = temp;
    }

    function getXPixel(val) {            //gets the x pixel for a graph point
        return ((graph.width() - xPadding) / xData.length) * val + (xPadding * 1.5);
    }

    function getYPixel(val) {           //gets the y pixel for a graph point
        return graph.height() - (((graph.height() - yPadding) / 13) * val) - yPadding;
    }

    $(document).ready(function() {
        graph = $('#graph');
        var write = graph[0].getContext('2d');

        write.lineWidth = 2;
        write.strokeStyle = '#333';
        write.textAlign = "center";

        for (var i=0; i < xData.length; i++){       //sorts the arrays to make sure the x axis is in chronological order
            for (var j=0; j < (xData.length) - i; j++){
                if (xData[j] > xData[j+1]){
                    swapData(xData, j, j+1);
                    swapData(yData, j, j+1);
                }
            }
        }

        write.beginPath();             //drawing the axis
        write.moveTo(xPadding, 0);
        write.lineTo(xPadding, graph.height() - yPadding);
        write.lineTo(graph.width(), graph.height() - yPadding);
        write.stroke();


        for(var i = 0; i < xData.length; i ++) {               //writing the X value texts
            write.fillText(xData[i], getXPixel(i), graph.height() - yPadding + 20);
        }


        write.textAlign = "right"                  //writing the Y value texts
        write.textBaseline = "middle";
        for(var i = 0; i < 13; i ++) {
            write.fillText(i, xPadding - 10, getYPixel(i));
        }
        write.strokeStyle = '#3366ff';


        write.beginPath();              //drawing the lines
        write.moveTo(getXPixel(0), getYPixel(yData[0]));
        for(var i = 1; i < xData.length; i ++) {
            write.lineTo(getXPixel(i), getYPixel(yData[i]));
        }
        write.stroke();


        write.fillStyle = '#333';       //drawing the points
        for(var i = 0; i < xData.length; i ++) {
            write.beginPath();
            write.arc(getXPixel(i), getYPixel(yData[i]), 4, 0, Math.PI * 2, true);
            write.fill();
        }
    });
</script>