<?php include_once '../model/DbContext.php';
$DB = new DbContext();

$username = $_POST['username'];

echo $DB->checkUsername($username);