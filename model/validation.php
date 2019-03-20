<?php

/**
 * Checks that name is only letters and not empty
 *
 * @param $name
 * @return bool
 */
function validName($name)
{
    if(1 === preg_match('~[0-9]+~', $name) OR $name == null) {
        return false;
    }
    return true;
}

/**
 * Checks that the given email is a valid email address
 *
 * @param $email
 * @return bool
 */
function validEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Checks that the given password is 8 or more characters
 *
 * @param $password
 * @return bool
 */
function validPassword($password)
{
    if (strlen($password) < 8) {
        return false;
    } else{
        return true;
    }
}