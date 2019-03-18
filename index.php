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
require_once 'model/db-functions.php';

//connect to database
$dbh = connect();
if(!$dbh){
    exit;
}

session_start();

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
        $fname="";
        $lname="";
        $email="";
        $password="";

        if(isset($_POST['fname'])) {
            $fname = $_POST['fname'];
            if(validName($fname)) {
                $isValid = true;
            } else {
                $isValid = false;
                $f3 -> set("errors['first']","Please enter a first name");
            }
        }

        if(isset($_POST['lname'])) {
            $lname = $_POST['lname'];
            if(validName($lname)) {
                $isValid = true;
            }
            else {
                $isValid = false;
                $f3->set("errors['last']", "Please enter a last name");
            }
        }

        if(isset($_POST['signUpEmail'])) {
            $email = $_POST['signUpEmail'];
            if(validEmail($email)) {
                $isValid = true;
            } else {
                $isValid = false;
                $f3->set("errors['email']","Please enter a valid email address");
            }
        }

        if(isset($_POST['signPassword'])) {
            $password = $_POST['signPassword'];
            $confirm = $_POST['confirmPass'];

            if(validPassword($password)) {
                if($password != $confirm) {
                    $isValid = false;
                    $f3 -> set("errors['confirmPass']","Passwords do not match.");
                } else{
                    $password = SHA1($password);
                    $isValid = true;
                }
            } else {
                $isValid = false;
                $f3->set("errors['password']", "Password must be 8 characters long.");
            }
        }

        if($isValid) {
            insertUsers($fname,$lname,$email,$password);

            //create new member object
            if(isset($_POST['premium'])) {
                $user_id = getUserId($email);

                $member = new PremiumUser($fname, $lname, $email, $user_id);
                $_SESSION['member'] = $member;
            } else {
                $user_id = getUserId($email);

                $member = new User($fname, $lname, $email, $user_id);
                $_SESSION['member'] = $member;
            }

            $f3->reroute("/landing");
        }

        //VALIDATE LOG IN INFORMATION IS IN DATABASE
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if(checkLogIn($email,$password)) {
                $member = getMember($email);

                //save member into session
                if($member['premium'] == 1) {
                    $member = new PremiumUser($member['fName'], $member['lName'], $member['email'], $member['user_id']);

                } else {
                    $member = new User($member['fName'], $member['lName'], $member['email'], $member['user_id']);
                }

                $_SESSION['member'] = $member;

                $f3->reroute("/landing");
            }
        }

    echo Template::instance()->render('views/home.html');
});

$f3->route('GET|POST /test', function ($f3)
{
    $template = new Template();
    echo $template->render('views/testpage.php');
});

$f3->route('GET|POST /landing', function ($f3)
{

    if(!isset($_SESSION['member']))
    {
        $f3->reroute('/');
    }

    $hikeNames = getHikeNames();
    $f3->set('hikeNames', $hikeNames);

    $goalDescriptions = getGoalDescriptions();
    $f3->set('goals', $goalDescriptions);

    $member = $_SESSION['member'];
    $user_id = $member->getUserId();
    $f3->set('user_id', $user_id);


    if(isset($_POST['trailName'])) {
        //add hike to database
        $hikeDetails = getHikeDetails($_POST['trailName']);
        $hike_id = $hikeDetails['hike_id'];
        if(!(checkHikeDuplicates($user_id,$hike_id)))
        {
            insertHike($user_id, $hike_id);
        }
    }

    if(isset($_POST['goals'])) {
        //add goals to database
        $goalDetails = getGoalDetails($_POST['goals']);
        $goal_id = $goalDetails['goal_id'];
        if(!(checkGoalDuplicates($user_id,$goal_id)))
        {
            insertGoal($user_id, $goal_id);
        }
    }

    if(isset($_POST['updateAmount'])) {
        $updateAmount = $_POST['updateAmount'];
        $goal_id = $_POST['goalUpdate'];
        updateCurrentGoal($updateAmount, $user_id, $goal_id);
    }


    //get information to generate table
    $tableInfo = generateHikeTable($user_id);
    $f3->set('tableInfo', $tableInfo);

    //get information to generate goals
    $goalTableInfo = generateGoalTable($user_id);
    $f3->set('goalTableInfo', $goalTableInfo);


    $template = new Template();
    echo $template->render('views/landing.html');
});

$f3->route('GET /logout', function($f3) {
    $view = new View();
    $view->render('model/logout.php');
});

//route after delete button on hike table is pressed to delete the hike
$f3->route('GET /@user_id/@hike_id', function($f3, $params) {

    $user_id = $params['user_id'];
    $hike_id = $params['hike_id'];

    deleteHike($user_id, $hike_id);

    $f3->reroute("landing");

});

//route after delete button on goal list is pressed to delete the goal
$f3->route('GET /goalDelete/@user_id/@goal_id', function($f3, $params) {

    $user_id = $params['user_id'];
    $goal_id = $params['goal_id'];

    deleteGoal($user_id, $goal_id);

    $f3->reroute("landing");
});



//Run fat free
$f3->run();