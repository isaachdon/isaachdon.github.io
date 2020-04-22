<?php
//link database page
require_once('includes/database.php');

//import form data
$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

//sql statement
$sql= "INSERT INTO users VALUES (NULL, '$firstname', '$lastname', '$username', '$password', 1)";

//query statement
$query = $conn->query($sql);

//start session if not started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//update login information
$_SESSION['login'] = $username;
$_SESSION['name'] = "$firstname $lastname";
$_SESSION['role'] = 1;
$_SESSION['login_status'] = 3;

header("location: login.php");
?>
</html>