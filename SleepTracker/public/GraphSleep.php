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
<body>
<div class="content">
    <div class="main">
        <h1>
            View sleep in a graph
        </h1>

        <div style="position:relative;top:35px;">
            <form action="DisplaySleepGraph.php" method="post">
                <div class="row" style="position:relative;top:35px;">
                    <div class="column">
                        Enter start date (Y-m-d):
                    </div>
                    <div class="column" style="position:relative;top:10px;">
                        <input type="text" name="startDate"/>
                    </div>
                    <div class="column" style="position:relative;top:10px;">
                        Enter end date (Y-m-d):
                    </div>
                    <div class="column" style="position:relative;top:10px;">
                        <input type="text" name="endDate"/>
                    </div>
                    <div class="column" style="position:relative;top:35px;">
                        <input type="submit" name="submitDate" value="submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
