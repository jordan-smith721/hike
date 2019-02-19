$(document).ready(function()
{
    var formLogin = $('#loginForm');
    var formSignup = $('#signupForm');

    //login modal AJAX
    $(formLogin).submit(function(event) {
        //stop the form from submitting
        event.preventDefault();

        //serialize the form data
        var formLoginData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "",
            data: formLoginData,
            success: function () {
                alert("SUCCESS");
            }
        })

    });

    //signup modal AJAX
    $(formSignup).submit(function(event) {
        //stop the form from submitting
        event.preventDefault();

        //serialize the form data
        var formSignupData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "",
            data: formSignupData,
            success: function (data) {
                alert("SUCCESS");
            }
        })

    });

});