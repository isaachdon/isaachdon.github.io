<?php

//start ssession
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//get cart array or start it
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = array();
}

//if productid can't be found, end script
if(!filter_has_var(INPUT_POST, 'value')){
    require_once('includes/header.php');
    echo "<h2 style=text-align:center;'> Product type cannot be found. Operation can't be processed.</h2>";
    include_once('includes/footer.php');
    die();
}

//get product id
$type = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);

//store array in session
$_SESSION['cart'] = $cart;

//redirect to cart.php
header("location:all_products.php?type=$type");