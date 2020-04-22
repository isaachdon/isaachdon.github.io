<?php
$page_title = "PHP Online Bookstore Add Book";
require_once 'includes/header.php';
require_once('includes/database.php');

if (!filter_has_var(INPUT_POST, 'color') ||
        !filter_has_var(INPUT_POST, 'type') ||
        !filter_has_var(INPUT_POST, 'price') ||
        !filter_has_var(INPUT_POST, 'stock') ||
        !filter_has_var(INPUT_POST, 'picture')){

    
    echo "There were problems retrieving product details. New product cannot be added.";
    require_once 'includes/footer.php';
    $conn->close();
    die();
}

//variables bringing in inputs
$color = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)));
$type = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
$stock = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT)));
$picture = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL)));

//sql statement to insert into products table
if($type != 'hat') {
    $sql = "INSERT INTO products VALUES (NULL, '$type', 'S,M,L,XL', '$price', '$stock', '$color', '$picture')";
} else {
    $sql = "INSERT INTO products VALUES (NULL, '$type', 'Unisex', '$price', '$stock', '$color', '$picture'";
}
        
//query statement
$query = $conn->query($sql);

//handle operation errors
if (!$query){
    $errno=$conn->errno;
    $errmsg=$conn->error;
    die("Connection to database failed:($errno)$errmsg.");
}


echo "<h3 style='text-align:center'>Product successfully added.</h3><br><br>";
require ('includes/footer.php');
?>
