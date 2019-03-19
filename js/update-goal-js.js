
$("#updateAmount").on("blur", function(){
    var updateValue = $("#updateAmount").val();
    var updateBox = $("#updateAmount");
    var updateError = $("#updateError");

    isValid = true;
    updateBox.removeClass("inputBoxError");
    updateError.removeClass("d-block");

    if(updateValue == "" || !(/^[0-9]*$/.test(updateValue)))
    {
        updateBox.addClass("inputBoxError");
        updateError.addClass("d-block");
        isValid = false;
    }
});

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
