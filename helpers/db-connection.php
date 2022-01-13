<?php

$host = "localhost:3306";
$user = "root";
$pass = "example";
$db = "contest";

$connection = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //you need to exit the script, if there is an error
    exit();
}

?>