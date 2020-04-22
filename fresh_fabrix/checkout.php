<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//if not login status is not set, redirect to login page
if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

//send to login page if not logged in and set login_status to 4 to tell the login page you came from checkout
if($_SESSION['login_status'] != 1) {
    $_SESSION['login_status'] = 4;
    //redirect to login.php
    header("location:login.php");
    exit;
}

//empty session
$_SESSION['cart'] = '';

$page_title = "Checkout";

require_once('includes/header.php');

?>

<h2 style="text-align:center">Checkout</h2>
<p style="text-align:center">
    Thanks for shopping for the best quality items around. You will be notified once your package has shipped.
</p>

<?php
    include('includes/footer.php');
