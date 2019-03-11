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
        passwordError.removeClass("d-block");

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


});
