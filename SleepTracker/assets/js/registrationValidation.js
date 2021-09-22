$(document).ready(function(){
    $("#register").click(function() {
        $('#forenameError').hide();
        $('#surnameError').hide();
        $('#usernameError').hide();
        $('#passwordError').hide();
        $('#confirmError').hide();
        $('#AgreeError').hide();

        var error = validation();

        var usernameMatch = checkUsername();

        var userAgree = userAgreement();

        if((usernameMatch !== true) && (error !== true) && (userAgree !== true))
        {
            var forename = $("#forename").val();
            var surname = $("#surname").val();
            var username = $("#newUsername").val();
            var password = CryptoJS.AES.encrypt($('#newPassword').val(), "x`3X,czaH%BY#>-gQ!6_vwe`:6`DM");

            var dataString = 'forename=' + forename + '&surname=' + surname + '&username=' + username +
                '&password=' + password;

            $.ajax({
                type: "POST",
                url: "../src/controller/processRegistration.php",
                data: dataString,
                success: function (response) {
                }
            });

            $('#registrationForm').hide();
            $('#success').show();
        }
    });
});

function validation()
{
    validation.error = Boolean(false);

    var forename = $("#forename").val();
    if(forename === "")
    {
        $('#forenameError').show();
        validation.error = Boolean(true);
    }

    var surname = $("#surname").val();
    if(surname === "")
    {
        $('#surnameError').show();
        validation.error = Boolean(true);
    }

    var username = $("#newUsername").val();
    if(username === "")
    {
        $('#usernameError').html('*Please Enter a Username').show();
        validation.error = Boolean(true);
    }

    var password = $("#newPassword").val();
    if(password === "")
    {
        $('#passwordError').show();
        validation.error = Boolean(true);
    }

    var confirmPassword = $("#confirmPassword").val();
    if(password.localeCompare(confirmPassword) !== 0)
    {
        $('#confirmError').show();
        validation.error = Boolean(true);
    }

    return validation.error;
}

function checkUsername()
{
    checkUsername.error = Boolean(false);
    var username = $("#newUsername").val();
    $.ajax({
        type: "POST",
        url: "../src/controller/checkUsername.php",
        async: false,
        data: "username=" + username,
        success: function (result) {
            if (result === '1') {
                $('#usernameError').html('*Username Already Exists').show();
                checkUsername.error = Boolean(true);
            }
        }
    })
    return checkUsername.error;
}

function userAgreement()
{
    var saveDataAgree = $('#saveData:checked').val();
    var deleteDataAgree = $('#deleteData:checked').val();

    if(saveDataAgree === "on" && deleteDataAgree === "on")
    {
        return false;
    }
    else
    {
        $('#AgreeError').show();
        return true;
    }
}
