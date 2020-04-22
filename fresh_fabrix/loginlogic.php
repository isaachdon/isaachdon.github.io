<?php

//start ssession
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//link database
include('includes/database.php');

//if productid can't be found, end script
if(!filter_has_var(INPUT_POST, 'username')){
    require_once('includes/header.php');
    echo "<h2 style=text-align:center;'>Incorrect username.</h2>";
    include_once('includes/footer.php');
    die();
}

//retrieve username and password
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

//sql statement
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

//query statement
$query = @$conn->query($sql);

if(!$query->num_rows == 1){
    $_SESSION['login_status'] = 2;
    //redirect to cart.php
    header("location:login.php");
    exit;
}

if($query->num_rows) {
    //it is a valid user. Need to store the user in session variables.
    $row = $query->fetch_assoc();
    $_SESSION['login'] = $username;
    $_SESSION['role'] = $row['role'];
    $_SESSION['name'] = $row['firstname'] . " " . $row['lastname'];
    $_SESSION['login_status'] = 1;
}

//redirect to cart.php
header("location:index.php");