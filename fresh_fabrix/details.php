<?php

$page_title = "Product Details";

require_once ('includes/header.php');

//link database page
require_once('includes/database.php');

//filter and sanitize incoming data
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT * FROM products WHERE productid='$id'";

//execute the query
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    //include the footer
    require_once ('includes/footer.php');
    exit;
}

//fetch associated variable
$row = $query->fetch_assoc();

//display results in a table in the below HTML block
?>
<body>
    <div style="text-align:center;">
        <?php echo "<img style='height:350px; display:inline-block; padding:20px' src='", $row['picture'], "'>" ?>

        <div style="display:inline-block; text-align:left; vertical-align: top; transform: translateY(25%);">
            <form method="post" action="cartlogic.php">
                <h1><?php echo $row['color'], " ", $row['type'] ?></h1>
                <p><?php echo "$", $row['price'] ?></p>
                <?php
                    if ($row['type'] != "hat") {
                        echo "<input type='radio' name='size' value='S' required>Small<br>";
                        echo "<input type='radio' name='size' value='M'>Medium<br>";
                        echo "<input type='radio' name='size' value='L'>Large<br>";
                        echo "<input type='radio' name='size' value='XL'>Extra Large<br>";
                    } else {
                        echo "<p>Unisex</p>";
                    }
                ?>
                <p><?php echo "Stock: ", $row['stock'] ?></p>
                
                <!-- hidden input to pass the productid -->
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input class="addtocartbutton" type="submit" name="Add to Cart" value="Add to Cart" />
            </form>
        </div>
        
        
    </div>
    
    <form style='text-align:center' action='deleteconfirmation.php' onsubmit="return confirm('You sure, fam?')">
        <?php
            if($role == 0) {
                echo "<input class='normalbuttons' type='submit' value='Delete Product'>&nbsp;";
                echo "<input class='normalbuttons' type='button'" . ' onclick="window.location.href=' . "'editproduct.php?id=$id'" . '" value="Edit Product" >';
                echo "<input type='hidden' name='id' value='", $row['productid'], "'>";
            }
            ?>
    </form>
</body>
<?php
include ('includes/footer.php');