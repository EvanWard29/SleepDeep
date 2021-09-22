<?php
include_once 'header.php';
include_once 'footer.php';
include_once 'sidebar.php';
?>

<body>
    <div class="w3-content">
        <div class="w4-left">
            <h1 style="font-size: 40px"><u>Registration</u></h1><br>
            <p id="success" style="font-size:18px" hidden>
                Registration Successful!
                <br>
                You can now sign in using the 'Login' tab.
            </p>
            <div id="registrationForm">
                <label style="color:red" id="forenameError" hidden>*Please Enter Your First Name</label><br>
                <label for="forename">First Name:</label>
                <input type="text" class="form-control" id="forename" placeholder="Enter First Name" name="forename" maxlength="25" required>

                <hr>

                <div class="form-group">
                    <label style="color:red" id="surnameError" hidden>*Please Enter Your Last Name</label><br>
                    <label for="surname">Surname:</label>
                    <input type="text" class="form-control" id="surname" placeholder="Enter Last Name" name="surname" maxlength="25" required>
                </div>

                <hr>

                <div class="form-group">
                    <label style="color:red" id="usernameError" hidden>*Username is Already Taken</label><br>
                    <label for="newUsername">Username:</label>
                    <input type="text" class="form-control" id="newUsername" placeholder="Enter Username" name="newUsername" maxlength="25" required>
                </div>

                <hr>

                <div class="form-group">
                    <label style="color:red" id="passwordError" hidden>*Please Enter A Password</label><br>
                    <label for="newPassword">Password:</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter Password" name="newPassword" maxlength="25" required>
                </div>

                <hr>

                <div class="form-group">
                    <label style="color:red" id="confirmError" hidden>*Passwords Do Not Match</label><br>
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword" maxlength="25" required>
                </div>

                <hr>

                <div class="form-group">
                    <label style="color:red" id="AgreeError" hidden>*You Must Agree To These Terms and Conditions</label><br>

                    <input type="checkbox" id="saveData" name="saveData" style="opacity: 1">
                    <label for="saveData" style="color:black;font-weight: bold; padding-left:15px">I agree to submitting my personal information to be saved and stored.</label>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="deleteData" name="deleteData" style="opacity: 1">
                    <label for="deleteData" style="color:black;font-weight: bold; padding-left:15px">I understand I can delete my data and user account when I wish to.</label>
                </div>

                <div><input type="submit" class="btn btn-default" name="register" id="register" value="Register"></div>
            </div>
        </div>
    </div>
</body>
<script src="../assets/js/registrationValidation.js"></script>
