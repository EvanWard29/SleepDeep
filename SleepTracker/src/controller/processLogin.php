<?php include_once '../model/DbContext.php';
$DB = new DbContext();

$username = $_POST['username'];

//Get User Details:
$userDetails = $DB->userLogin($username);

$details = array($userDetails->getUserID(),$userDetails->getPassword());

echo json_encode($details);
/*if ($password == $userDetails->getPassword())
{
    //Success! Username and password confirmed
    $_SESSION['userLogged'] = 1;
    $_SESSION['user'] = $userDetails->getUserID();
    header('Location: index.php');
} else {
    //Indicates password failure
    $_SESSION['userLogged'] = 0;

    echo "<script>$('#error').show()</script>";
}*/

