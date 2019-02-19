<?php
/**
 * Created by PhpStorm.
 * User: Jsmit
 * Date: 2/8/2019
 * Time: 9:28 AM
 */


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';

//Create an instance of the Base class
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

//require validation page
require_once('model/validation.php');

//Define a default route
$f3->route('GET|POST /', function ($f3)
{

    //VALIDATE SIGN UP FORM
        $isValid = false;

        if(isset($_POST['fname']))
        {
            $fname = $_POST['fname'];
            if(validName($fname))
            {
                $isValid = true;
            }
            else
            {
                $isValid = false;
                $f3 -> set("errors['first']","Please enter a first name");
            }
        }

        if(isset($_POST['lname']))
        {
            $lname = $_POST['lname'];
            if(validName($lname))
            {
                $isValid = true;
            }
            else
            {
                $isValid = false;
                $f3->set("errors['last']", "Please enter a last name");
            }
        }

        if(isset($_POST['signUpEmail']))
        {
            $email = $_POST['signUpEmail'];
            if(validEmail($email))
            {
                $isValid = true;
            }
            else
            {
                $isValid = false;
                $f3->set("errors['email']","Please enter a valid email address");
            }
        }

        if(isset($_POST['signPassword']))
        {
            $password = $_POST['signPassword'];
            $confirm = $_POST['confirmPass'];

            if(validPassword($password))
            {
                if($password != $confirm)
                {
                    $isValid = false;
                    $f3 -> set("errors['confirmPass']","Passwords do not match.");
                }
                else{
                    $isValid = true;
                }
            }
            else
            {
                $isValid = false;
                $f3->set("errors['password']", "Password must be 8 characters long.");
            }
        }

        if($isValid)
        {
            $f3->reroute("/test");
        }


    //VALIDATE LOG IN INFORMATION IS IN DATABASE
        //code will go here

    echo Template::instance()->render('views/home.html');
});

$f3->route('GET|POST /test', function ($f3)
{
    $template = new Template();
    echo $template->render('views/testpage.html');
});

$f3->route('GET|POST /landing', function ($f3)
{
    $template = new Template();
    echo $template->render('views/landing.html');
});



//Run fat free
$f3->run();