<?php
    include_once 'header.php';
    include_once 'footer.php';
    include_once 'sidebar.php';
?>
<head>
    <link href="../assets/css/index.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="item"><h5>Add or View sleeps</h5></div>
            <ul>
                <div class="item"><li><a href="AddSleep.php"><h6>Add sleep</h6></a></li></div>
                <div class="item"><li><a href="ViewSleep.php"><h6>View sleep</h6></a></li></div>
                <div class="item"><li><a href="WeeklySleep.php"><h6>View sleep for a week</h6></a></li></div>
                <div class="item"><li><a href="DisplayShortSleep.php"><h6>View sleep when you slept less than 6h</h6></a></li></div>
                <div class="item"><li><a href="DisplayLongSleep.php"><h6>View sleep when you slept more than 8h</h6></a></li></div>
                <div class="item"><li><a href="GraphSleep.php"><h6>View sleep in a graph</h6></a></li></div>

            </ul>
        </div>
    </div>
</body>
