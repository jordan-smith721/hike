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

//Define a default route
$f3->route('GET /', function ()
{
    echo Template::instance()->render('views/home.html');
});

//Run fat free
$f3->run();