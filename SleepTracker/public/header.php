<?php
include_once '../src/model/DbContext.php'; session_start();
require_once "../assets/libs/Mobile_Detect.php";
$detect = new Mobile_Detect;
?>

<html>
<head>
    <link href="../assets/css/header.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
</head>

<body class="grey lighten-3">
    <div class="header">
        <a href="./index.php" class="logo">Sleep Deep</a>
        <div class="header-right">
            <div class="a_class">
                <a href="./index.php" class="active">Home</a>
                <?php
                if(isset($_SESSION['userLogged']) && $_SESSION['userLogged'] == 1)
                {
                    ?>
                    <a href="usersettings.php">User Settings</a>
                    <a href="index.php?logout=true">Logout</a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="login.php">Login</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if((isset($_GET['logout'])) && ($_GET['logout'] == 'true'))
{
$_SESSION['userLogged'] = 0;
$_SESSION['user'] = null;
header('Location: index.php');
}
?>

