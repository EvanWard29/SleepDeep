<?php
session_start();
$userID = $_POST['userID'];

$_SESSION['userLogged'] = 1;
$_SESSION['user'] = $userID;

echo $_SESSION['userLogged'];



