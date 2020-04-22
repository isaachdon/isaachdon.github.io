<?php
//start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//create variable for how many items are in the cart
$count = 0;

//get actual cart count
if(isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    
    if($cart) {
        $count = array_sum($cart);
    }
}

//variables for a user's login, name, and role
$login = "";
$name = "";
$role = 1;

//if the user has logged in, retrieve login, name, and role
if(isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $role = $_SESSION['role'];
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $page_title ?></title>
        
        <link href="public/styles.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        
        <div class="tabler" align="center">
            
            <ul>
                <?php
                    if(empty($login)) {
                        echo "<li><a style='left:0px; top:0px; position:absolute;' href='login.php'>Log In/Sign Up</a></li>";
                    } else {
                        echo "<li style='left:0px; top:0px; position:absolute'><span style='color:white; margin-left:30px'>Welcome, $name</style>&nbsp;&nbsp;<a style='display:inline-block' href='logout.php'>Logout</a></li>";
                    }
                ?>
                <li><h1 class="colgate" id="banner" style="text-shadow:5px 5px #b70303;">Fresh Fabrix</h1></li><br>
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <?php
                    if($role == 0) {
                        echo "<li><a href='addProducts.php'>Add a Product</a></li>";
                    }
                ?>
                <?php
                    if($count == 0) {
                        echo "<a href='cart.php'><img id='cart' src='images/cart.png'></a>";
                    }
                    if($count != 0) {
                        echo "<a href='cart.php'><img id='cart' src='images/fullcart.png'></a>";
                    }
                ?>
                <p style="color: white; position:absolute; right:60px; top:100px">Items in Cart: <?php echo $count ?></p>
            </ul>
            
        </div>