var isValid = false;

$(document).ready(function()
{

    var fname = $('#fname');
    var lname = $('#lname');
    var signUpEmail = $('#signUpEmail');
    var signUpPassword = $('#signPassword');
    var confirmPass = $('#confirmPass');
    var fnameError = $('#fnameError');
    var lnameError = $('#lnameError');
    var emailError = $('#emailError');
    var passwordError = $('#passwordError');
    var confirmError = $('#confirmError');


    /*************************************************
     SIGNUP MODAL VALIDATION
    **************************************************/

    $(fname).on("blur", function ()
    {
        isValid = true;
        fname.removeClass("inputBoxError");
        fnameError.removeClass("d-block");
        //if field is empty or contains anything besides words
        if (fname.val() === "" || !(/^[a-zA-Z]+$/.test(fname.val())))
        {
            fname.addClass("inputBoxError");
            fnameError.addClass("d-block");
            isValid = false;
        }
    });

    $(lname).on("blur", function ()
    {
        lname.removeClass("inputBoxError");
        lnameError.removeClass("d-block");
        //if field is empty or contains anything besides words
        if (lname.val() === "" || !(/^[a-zA-Z]+$/.test(lname.val())))
        {
            lname.addClass("inputBoxError");
            lnameError.addClass("d-block");
            isValid = false;
        }
    });

    $(signUpEmail).on("blur", function ()
    {
        signUpEmail.removeClass("inputBoxError");
        emailError.removeClass("d-block");

        //if field is not an email address make it an error
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (regex.test(signUpEmail.val()) == false)
        {
            signUpEmail.addClass("inputBoxError");
            emailError.addClass("d-block");
            isValid = false;
        }
    });

    $(signUpPassword).on("blur", function ()
    {
        signUpPassword.removeClass("inputBoxError");
        passwordError.removeClass("d-block");

        if(signUpPassword.val().length < 8)
        {
            signUpPassword.addClass("inputBoxError");
            passwordError.addClass("d-block");
            isValid = false;
        }

    });

    $(confirmPass).on("blur", function ()
    {
        confirmPass.removeClass("inputBoxError");
        confirmError.removeClass("d-block");

        if(confirmPass.val() != signUpPassword.val())
        {
            confirmPass.addClass("inputBoxError");
            confirmError.addClass("d-block");
            isValid = false;

        }
    });

    var signupForm = $('#signupForm');
    $(signupForm).on("submit", function()
    {
        if (!isValid)
        {
            event.preventDefault();
        }
    });

    /*************************************************
     LOGIN MODAL VALIDATION
     **************************************************/

    var loginEmailForm = $("#email");
    var loginPasswordForm = $("#password");
    var loginEmailErr = $("#loginEmailErr");
    var loginPassErr = $("#loginPassErr");

    //validate email box on blur
    $(loginEmailForm).on("blur", function ()
    {
        loginEmailForm.removeClass("inputBoxError");
        loginEmailErr.removeClass("d-block");

        //if field is not an email address make it an error
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (regex.test(loginEmailForm.val()) == false)
        {
            loginEmailForm.addClass("inputBoxError");
            loginEmailErr.addClass("d-block");
        }
    });

    //validate password is not empty
    $(loginPasswordForm).on("blur", function ()
    {
        loginPasswordForm.removeClass("inputBoxError");
        loginPassErr.removeClass("d-block");

        if(loginPasswordForm.val().length == 0)
        {
            loginPasswordForm.addClass("inputBoxError");
            loginPassErr.addClass("d-block");
        }
    });

    //validate that the user exists on login
    var loginForm = $("#loginForm");
    $(loginForm).on("submit", function(e)
    {
        //don't submit the form
        e.preventDefault();

        var loginEmail = $("#email").val();
        var loginPass = $("#password").val();

        //send data to validation form
        $.post(
            'checkLogIn.php',
            {loginEmail: loginEmail,
             loginPass: loginPass},
             function(result)
             {
                 //if it is a valid user submit the form
                 if(result == "success")
                 {
                     $("invalidLogin").removeClass("d-block");
                     $(loginForm).unbind().submit();
                 }
                 //display an error if the login is not valid
                 else
                 {
                    $("#invalidLogin").addClass("d-block");
                 }
             });
    })
});
