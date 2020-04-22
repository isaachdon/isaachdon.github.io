<?php
$page_title = "Shopping Cart";

//link header
include ('includes/header.php');

//link database page
require_once('includes/database.php');

//filter and sanitize incoming data
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

//if cart is empty
if(!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "<br><h2 style='text-align:center'>your cart is empty</h2><br>";
    include('includes/footer.php');
    exit();
}

//placeholder for size variable
$sizevalue = "";

//if cart is not empty
$cart = $_SESSION['cart'];

?>
    <div style="text-align:center">
        <h1>Your Cart</h1>
        <table style="display: table; table-layout: fixed; width: 100%;">
            <tr>
                <th></th>
                <th></th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>                
            </tr>
            <?php
            //show cart items
            //sql statement
            $sql = "SELECT * FROM products WHERE 0";
            foreach(array_keys($cart) as $id) {
                $sql .= " OR productid=$id";
            }
            
            //query statement
            $query = $conn->query($sql);
            
            //create variable to store total
            $finaltotal = 0;
            
            //fetch products and display them in table
            while($row = $query->fetch_assoc()) {
                //set variables
                $id = $row['productid'];
                $type = $row['type'];
                $price = $row['price'];
                $stock = $row['stock'];
                $color = $row['color'];
                $sizevalue = $row['size'];
                $picture = $row['picture'];
                $quantity = $cart[$id];
                $total = $price * $quantity;
                
                $finaltotal = $finaltotal + $total;
                
                //display this to the user
                echo "<tr>";
                echo "<td><img style='height:100px' src='$picture'></td>";
                echo "<td><a href='details.php?id=$id'>$color", " ", "$type</a></td>";
                echo "<td>$sizevalue</td>";
                echo "<td>$$price</td>";
                echo "<td><a class='normalbuttons' style='padding:5px 10px' href='minusqty.php?id=$id'>-</a>&nbsp;$quantity&nbsp;<a class='normalbuttons' style='padding:5px 10px' href='plusqty.php?id=$id'>+</a></td>";
                echo "<td>$$total</td>";
            }
            
            ?>
        </table>
        
        <h2 style="text-align:center">Order Total: $<?php echo $finaltotal ?></h2><br>
        <div>
            <input type="button" class="normalbuttons" onclick="window.location.href='checkout.php'" value="Checkout">
            <input type="button" class="normalbuttons" onclick="window.history.back()" value="Go Back">
        </div>
    </div>
<br>    
<?php
require 'includes/footer.php';
?>

