<?php
$page_title = "Edit Product";
require 'includes/header.php';
require_once('includes/database.php');

if($role == 1) {
    echo "<h1 style='text-align:center'>You are not authorized for this page</h1>";
    include("includes/footer.php");
    exit;
}

//import product id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT * FROM products WHERE productid=$id";

//query
$query = $conn->query($sql);

//get results
$row = $query->fetch_assoc();

//handle errors
if (!$query) {
    $errrno = $conn->errno;
    $errmssg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>/n";
    $conn->close();
    //include footer
    require_once ('includes/footer.php');
    exit;
}

?>

<body>
    <div style="text-align:center;">
        <br>
        <h1><?php echo $row['color'], " ", $row['type'] ?></h1>
        <?php echo "<img style='height:350px; display:inline-block; padding:20px; transform:translateY(-40px)' src='", $row['picture'], "'>" ?>
        
        <form action="editconfirmation.php" method="post" style="display:inline-block; text-align:left; transform: translateY(-40px)">
            <table>
                <tr>
                    <td><input name="id" type="hidden" value="<?php echo $row['productid'] ?>" readonly></td>
                </tr>
                <tr>
                    <td>Type:</td>
                    <td><input name="type" type="text" value="<?php echo $row['type'] ?>" readonly ></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input name="price" type="float" value="<?php echo $row['price'] ?>" required></td>
                </tr>
                <tr>
                    <td>Stock:</td>
                    <td><input name="stock" type="number" value="<?php echo $row['stock'] ?>" required></td>
                </tr>
                <tr>
                    <td>Color:</td>
                    <td><input name="color" type="text" value="<?php echo $row['color'] ?>" required></td>
                </tr>
                <tr>
                    <td>Image URL:</td>
                    <td><input name="picture" type="text" value="<?php echo $row['picture'] ?>" required></td>
                </tr>
                
            </table>
            <!-- confirm  and cancel buttons -->
            <div style="text-align:center">
                <input class="normalbuttons" type="submit" value="Update">
                <input class="normalbuttons" type="button" onclick="window.history.back()" value="Cancel">
            </div>
        </form>
        
        
    </div>
    
</body>

<?php

//close connection
$conn->close();

require ('includes/footer.php');