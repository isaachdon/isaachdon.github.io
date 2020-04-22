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
if(!filter_has_var(INPUT_GET, 'id')){
    require_once('includes/header.php');
    echo "<h2 style=text-align:center;'> Product id cannot be found. Operation can't be processed.</h2>";
    include_once('includes/footer.php');
    die();
}

//get product id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$size = filter_input(INPUT_POST, "size", FILTER_SANITIZE_STRING);

//update existing product in cart or add new product
if(array_key_exists($id, $cart)) {
    $cart[$id] = $cart[$id] - 1;
}

//if 0, remove from array
if($cart[$id]==0) {
    unset($cart[$id]);
}

//store array in session
$_SESSION['cart'] = $cart;

//redirect to cart.php
header("location:cart.php?size=$size");