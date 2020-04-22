<?php

//start session if it has not already started
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//unset all the session variables
$_SESSION = array();

//delete the session cookie
setcookie(session_name(), "", time() - 3600);

//destroy the session
session_destroy();

$page_title = "Logout";
include('includes/header.php');
?>
<div style="text-align:center">
    <h1>Thank you for visiting. You are now logged out</h1>
</div>

<?php
include('includes/footer.php');