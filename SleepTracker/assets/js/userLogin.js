$(document).ready(function(){
    $("#login").click(function() {
        $('#blankUsername').hide();
        $('#blankPassword').hide();

        if(formValidation() !== Boolean(true))
        {
            var username = $('#username').val();
            var dataString = 'username=' + username;

            $.ajax({
                type: "POST",
                url: "../src/controller/processLogin.php",
                data: dataString,
                success: function (response) {
                    checkPassword(response);
                },
                dataType: "json"
            });
        }
    });
});

function formValidation()
{
    formValidation.error = Boolean(false);

    if($('#username').val() === "")
    {
        $('#blankUsername').show();
        formValidation.error = Boolean(true);

    }
    if($('#password').val() === "")
    {
        $('#blankPassword').show();
        formValidation.error = Boolean(true);
    }

    return formValidation.error
}

function checkPassword(userDetails)
{
    var userID = userDetails[0];
    var userPassword = CryptoJS.AES.decrypt(userDetails[1], "x`3X,czaH%BY#>-gQ!6_vwe`:6`DM");

    var encryptEntered = CryptoJS.AES.encrypt($('#password').val(), "x`3X,czaH%BY#>-gQ!6_vwe`:6`DM");
    var decryptEntered = CryptoJS.AES.decrypt(encryptEntered, "x`3X,czaH%BY#>-gQ!6_vwe`:6`DM");

    console.log(encryptEntered.toString());

    if(userPassword.toString() === decryptEntered.toString())
    {
        var dataString = 'userID=' + userID;

        //Ajax to Set User Session
        $.ajax({
            type: "POST",
            url: "../src/controller/setUserSession.php",
            data: dataString,
            success: function (response) {
                //alert(response)
                window.location.href = "index.php";
            }
        });
    }
    else
    {
        $('#error').show();
    }
}