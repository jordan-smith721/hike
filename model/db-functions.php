<?php

require_once ('/home/jsmithgr/config.php');

function connect(){
    try{
        $dbh = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD);
        return $dbh;
    }
    catch(PDOException $e){
        echo $e->getMessage();
        return false;
    }
}

function insertUsers($fname,$lname,$email,$password)
{
    global $dbh;

    $sql = "INSERT INTO users(fName, lName, email, password)
                        VALUES(:fName, :lName, :email, :password)";

    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':fName',$fname,PDO::PARAM_STR);
    $statement->bindParam(':lName',$lname,PDO::PARAM_STR);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement->bindParam(':password',$password,PDO::PARAM_STR);

    $success = $statement->execute();
    return $success;
}

function checkLogIn($email,$password)
{
    global $dbh;

    $sql = "SELECT email, password FROM users 
            WHERE (email = :email) AND (password = SHA1(:password))";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement->bindParam(':password',$password,PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getHikeNames()
{
    global $dbh;

    $sql = "SELECT hike_id, trailName FROM hikes";

    $statement = $dbh->prepare($sql);
    $statement-> execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function getHikeDetails($trailName)
{
    global $dbh;

    $sql = "SELECT * FROM hikes WHERE trailName = :trailName";


    $statement = $dbh->prepare($sql);
    $statement->bindParam(':trailName',$trailName,PDO::PARAM_STR);
    $statement-> execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function getUserId($email)
{
    global $dbh;

    $sql = "SELECT user_id FROM users WHERE email = :email";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':email',$email,PDO::PARAM_STR);
    $statement-> execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function insertHike($user_id, $hike_id)
{
    global $dbh;

    $sql = "INSERT INTO userHikes VALUES (:user_id, :hike_id)";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id',$user_id,PDO::PARAM_STR);
    $statement->bindParam(':hike_id', $hike_id,PDO::PARAM_STR);

    $statement-> execute();
}

function getMember($email)
{
    global $dbh;

    $sql = "SELECT user_id, fName, lName, email, premium FROM users WHERE email = :email";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':email',$email ,PDO::PARAM_STR);

    $statement-> execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;

}

function generateHikeTable($user_id)
{
    global $dbh;

    $sql = "SELECT * FROM hikes h, userHikes u WHERE u.user_id = :user_id AND u.hike_id = h.hike_id ";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':user_id',$user_id ,PDO::PARAM_STR);

    $statement-> execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}