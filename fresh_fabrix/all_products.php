<?php


$page_title = "All Products";

require 'includes/header.php';

//link database page
require_once('includes/database.php');

//get product id
$type = filter_input(INPUT_GET, 'value', FILTER_SANITIZE_STRING);

//select statements for filter
if($type == "") {
    $sql = "SELECT * FROM products";
} elseif($type == "lowtohigh") {
    $sql = "SELECT * FROM products ORDER BY price ASC";
} elseif($type == "hightolow") {
    $sql = "SELECT * FROM products ORDER BY price DESC";
} elseif($type == "black") {
    $sql = "SELECT * FROM products WHERE color='$type'";
} elseif($type == "white") {
    $sql = "SELECT * FROM products WHERE color='$type'";
} elseif($type == "grey") {
    $sql = "SELECT * FROM products WHERE color='$type'";
} elseif($type == "toothpaste") {
    $sql = "SELECT * FROM products WHERE color='$type'";
} elseif($type == "galaxy") {
    $sql = "SELECT * FROM products WHERE color='$type'";
}  else {
    $sql = "SELECT * FROM products WHERE type='$type'";
}

//execute the query
$query = $conn->query($sql);

//handle operation errors
if (!$query){
    $errno=$conn->errno;
    $errmsg=$conn->error;
    die("Connection to database failed:($errno)$errmsg.");
}

?>


<h1 align="center" style="font-size:40pt">All Products</h1>

<form style="text-align:center" action="search.php" method="get">
    <input class="searchbar" type="text" name="input" placeholder="Search..." required /> &nbsp;
    <input class="searchbutton" type="submit" name="Submit" value="Search" />
</form>

<form id="filter" action="all_products.php" method="get">
    <tr>
        <td>Filter By:</td>
        <td> <select name="value" onchange="this.form.submit()">
                <option value=""<?php if($type == "") { echo "selected"; }?>>None</option>
                <option value="shirt" <?php if($type == "shirt") { echo "selected"; }?>>Shirts</option>
                <option value="pants" <?php if($type == "pants") { echo "selected"; }?>>Pants</option>
                <option value="hat" <?php if($type == "hat") { echo "selected"; }?>>Hats</option>
                <option value="lowtohigh" <?php if($type == "lowtohigh") { echo "selected"; }?>>Price: Low to High</option>
                <option value="hightolow" <?php if($type == "hightolow") { echo "selected"; }?>>Price: High to Low</option>
                <option value="black" <?php if($type == "black") { echo "selected"; }?>>Black</option>
                <option value="white" <?php if($type == "white") { echo "selected"; }?>>White</option>
                <option value="grey" <?php if($type == "grey") { echo "selected"; }?>>Grey</option>
                <option value="toothpaste" <?php if($type == "toothpaste") { echo "selected"; }?>>Toothpaste</option>
                <option value="galaxy" <?php if($type == "galaxy") { echo "selected"; }?>>Galaxy</option>
          </select> </td>
    </tr>
</form>
    
<div style="text-align:center">
    <?php
        while(($row = $query->fetch_assoc()) !== NULL) {
            echo "<a href='details.php?id=", $row['productid'], "'><div class='darken' style='padding:20px; display:inline-block'>";
            echo "<img style='height:300px' src='", $row['picture'], "'><br>";
            echo "$", $row['price'];
            echo "</div></a>";
        }
    ?>
</div>
    

<?php
require("includes/footer.php");
?>