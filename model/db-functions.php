<?php


/**
 * Require the config.php file that allows access to a database
 */
require_once('/home/jsmithgr/config.php');


/**
 * Connects to the database
 *
 * This will return true if the database was connected to successfully
 * or false if there is some sort of error.
 *
 * @return bool|PDO
 */
function connect()
{
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        return $dbh;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

/**
 *
 * Inserts users into the users table in SQL using PDO
 *
 * @param $fname
 * @param $lname
 * @param $email
 * @param $password
 * @return bool
 */
function insertUsers($fname, $lname, $email, $password, $premiumMember)
{
    global $dbh;

    $sql = "INSERT INTO users(fName, lName, email, password, premium)
                        VALUES(:fName, :lName, :email, :password, :premiumMember)";

    $statement = $dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':fName', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lName', $lname, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':premiumMember', $premiumMember, PDO::PARAM_STR);

    $success = $statement->execute();
    return $success;
}

/**
 * Verifies that the user is already in the database before logging in.
 *
 * @param $email
 * @param $password
 * @return mixed
 */
function checkLogIn($email, $password)
{
    global $dbh;

    $sql = "SELECT email, password FROM users 
            WHERE (email = :email) AND (password = SHA1(:password))";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Creates an array of hike names to be displayed as a drop down menu
 *
 * @return array
 */
function getHikeNames()
{
    global $dbh;

    $sql = "SELECT hike_id, trailName FROM hikes";

    $statement = $dbh->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Takes one trail name as a parameter and returns all information about that trail
 *
 * @param $trailName
 * @return mixed
 */
function getHikeDetails($trailName)
{
    global $dbh;

    $sql = "SELECT * FROM hikes WHERE trailName = :trailName";


    $statement = $dbh->prepare($sql);
    $statement->bindParam(':trailName', $trailName, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Gets the user_id of the user that is currently logged in
 *
 * @param $email
 * @return mixed
 */
function getUserId($email)
{
    global $dbh;

    $sql = "SELECT user_id FROM users WHERE email = :email";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Inserts a hike that is attached to the specified user.
 *
 * @param $user_id
 * @param $hike_id
 */
function insertHike($user_id, $hike_id)
{
    global $dbh;

    $sql = "INSERT INTO userHikes VALUES (:user_id, :hike_id)";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':hike_id', $hike_id, PDO::PARAM_STR);

    $statement->execute();
}

/**
 * Inserts a new goal into the users database
 *
 * @param $user_id
 * @param $goal_id
 */
function insertGoal($user_id, $goal_id)
{
    global $dbh;

    $sql = "INSERT INTO userGoals(user_id, goal_id) VALUES (:user_id, :goal_id)";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':goal_id', $goal_id, PDO::PARAM_STR);

    $statement->execute();
}

/**
 * Gets the member details based on a member email
 *
 * @param $email
 * @return mixed
 */
function getMember($email)
{
    global $dbh;

    $sql = "SELECT user_id, fName, lName, email, premium FROM users WHERE email = :email";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':email', $email, PDO::PARAM_STR);

    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;

}

/**
 * Gets all of the hike data for a specific user
 *
 * @param $user_id
 * @return array
 */
function generateHikeTable($user_id)
{
    global $dbh;

    $sql = "SELECT * FROM hikes h, userHikes u WHERE u.user_id = :user_id AND u.hike_id = h.hike_id ";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Gets all the goal information for a specific user
 *
 * @param $user_id
 * @return array
 */
function generateGoalTable($user_id)
{
    global $dbh;

    $sql = "SELECT * FROM goals g, userGoals u WHERE u.user_id = :user_id AND u.goal_id = g.goal_id ";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Gets the description(name) of all hikes
 *
 * @return array
 */
function getGoalDescriptions()
{
    global $dbh;

    $sql = "SELECT goal_id, description FROM goals";

    $statement = $dbh->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Gets the details for a specific hike
 *
 * @param $description
 * @return mixed
 */
function getGoalDetails($description)
{
    global $dbh;

    $sql = "SELECT * FROM goals WHERE description = :description";


    $statement = $dbh->prepare($sql);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Updates the current amount the user has achieved towards a certain goal
 *
 * @param $updateGoal
 * @param $user_id
 * @param $goal_id
 * @return mixed
 */
function updateCurrentGoal($updateGoal, $user_id, $goal_id)
{
    global $dbh;

    $sql = "UPDATE userGoals SET currentGoal = currentGoal + :updateGoal 
            WHERE user_id = :user_id AND goal_id = :goal_id ";

    $statement = $dbh->prepare($sql);

    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':updateGoal', $updateGoal, PDO::PARAM_STR);
    $statement->bindParam(':goal_id', $goal_id, PDO::PARAM_STR);

    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Gets the current amount a user has achieved towards a certain goal
 *
 * @param $user_id
 * @param $goal_id
 * @return mixed
 */
function getCurrentGoal($user_id, $goal_id)
{
    global $dbh;

    $sql = "SELECT currentGoal FROM goals g, userGoals u 
            WHERE u.user_id = :user_id AND u.goal_id = g.goal_id ";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':goal_id', $goal_id, PDO::PARAM_STR);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Deletes a goal from the users database
 *
 * @param $user_id
 * @param $goal_id
 */
function deleteGoal($user_id, $goal_id)
{
    global $dbh;

    $sql = "DELETE FROM userGoals where user_id = :user_id AND goal_id = :goal_id";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':goal_id', $goal_id, PDO::PARAM_STR);
    $statement->execute();

}


/**
 * Deletes a hike from the users database
 *
 * @param $user_id
 * @param $hike_id
 */
function deleteHike($user_id, $hike_id)
{
    global $dbh;

    $sql = "DELETE FROM userHikes where user_id = :user_id AND hike_id = :hike_id";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':hike_id', $hike_id, PDO::PARAM_STR);
    $statement->execute();
}

/**
 * Checks if a hike has already been added to the database
 *
 * @param $user_id
 * @param $hike_id
 * @return bool
 */
function checkHikeDuplicates($user_id,$hike_id)
{
    global $dbh;

    $sql = "SELECT * FROM userHikes WHERE user_id = :user_id AND hike_id = :hike_id";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':hike_id', $hike_id, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->rowCount();

    if($result >= 1 )
    {
        return true;
    }

    return false;
}

/**
 * Checks if a goal has already been added to the database
 *
 * @param $user_id
 * @param $goal_id
 * @return bool
 */
function checkGoalDuplicates($user_id,$goal_id)
{
    global $dbh;

    $sql = "SELECT * FROM userGoals WHERE user_id = :user_id AND goal_id = :goal_id";

    $statement = $dbh->prepare($sql);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->bindParam(':goal_id', $goal_id, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->rowCount();

    if($result >=1 )
    {
        return true;
    }

    return false;
}