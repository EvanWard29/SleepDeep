<?php include_once '../model/DbContext.php';
$DB = new DbContext();

$forename = $_POST['forename'];
$surname = $_POST['surname'];
$username = $_POST['username'];
$password = $_POST['password'];

$newUser = new User(null,$forename, $surname, $username, $password);
$DB->addUser($newUser);


