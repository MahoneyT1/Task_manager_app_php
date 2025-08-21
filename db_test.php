<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

// mysql credentails
$server_name = "localhost";
$username = "task_manager";
$user_pwd = "Drew2325$$";


// specify your database name
$db_name = "task_manager_db";
$conn = new mysqli($server_name, $username, $user_pwd, $db_name);

// check if connection fails

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
};

echo "Connected to mysql database successfully ";

?>