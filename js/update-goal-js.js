$("#updateAmount").on("blur", function(){
    var updateValue = $("#updateAmount").val();
    var updateBox = $("#updateAmount");
    var updateError = $("#updateError");

    isValid = true;
    updateBox.removeClass("inputBoxError");
    updateError.removeClass("d-block");

    //check if update value box is numbers only
    if(updateValue == "" || !(/^[0-9]*$/.test(updateValue)))
    {
        updateBox.addClass("inputBoxError");
        updateError.addClass("d-block");
        isValid = false;
    }
});

//check that update is valid on server side
var updateGoalForm = $('#updateGoalForm');
$(updateGoalForm).on("submit", function()
{
    if (!isValid)
    {
        event.preventDefault();
    }
    else
    {
        //Use Ajax to validate with php
        $.post('updateGoalValidation.php',
            {updateGoal: updateValue}
        );
    }

});
