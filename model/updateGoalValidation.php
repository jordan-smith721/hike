<?php
$updateGoal = $_POST['updateGoal'];

//check that update goal value is only numbers
if(isset($updateGoal)) {
    if (preg_match("^[0-9]*$",$updateGoal)) {
        return true;
    }

    echo "Please update using numbers only";
    return false;
}