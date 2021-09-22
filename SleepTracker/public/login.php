<?php
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';
?>
<html>
<head>
    <link href="../assets/css/loginForm.css" type="text/css" rel="stylesheet" />
</head>
    <div id="loginForm" class="wrapper">
        <div class="form-group">
            <label id="blankUsername" style="color: red" hidden>Username Cannot Be Empty!</label><br>
            <label style="font-size:16px" for="username">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
        </div>
        <div class="form-group">
            <label id="blankPassword" style="color: red" hidden>Password Cannot Be Empty!</label><br>
            <label style="font-size:16px" for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="w3-center"><input type="submit" class="btn btn-default " id="login" name="login" value="Login"></div>

        <label id="error" style="color: red; align-self: center;padding-top: 20px" hidden>Incorrect Username or Password</label>
        <label style="align-self: center; padding-top: 20px">Need an Account?<a href="registration.php"><span style="color:dodgerblue">Register Here</span></a></label>
    </div>
</html>

<script src="../assets/js/userLogin.js"></script>
