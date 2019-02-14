<?php

function validName($name)
{
    if(1 === preg_match('~[0-9]+~', $name) OR $name == null)
    {
        return false;
    }
    return true;
}

function validEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validPassword($password)
{
    if (strlen($password) < 8)
    {
        return false;
    }else{
        return true;
    }
}