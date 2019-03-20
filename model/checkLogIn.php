<?php
$email = $_POST['loginEmail'];
$password = $_POST['loginPass'];
global $dbh;

//define statement to check that the user gave a correct login
$sql = "SELECT email, password FROM users
        WHERE (email = :email) AND (password = SHA1(:password))";

//prepare and bind parameters
$statement = $dbh->prepare($sql);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':password', $password, PDO::PARAM_STR);

//execute statement and count how many rows were returned
$statement->execute();
$result = $statement->rowCount();

//if no rows are returned then login fails
if($result < 1)
{
    echo "fail";
}
else
{
    echo "success";
}