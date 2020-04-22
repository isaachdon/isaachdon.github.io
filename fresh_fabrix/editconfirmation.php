<?php
$page_title = "Edit Database";
require 'includes/header.php';
require_once('includes/database.php');

//import new variables
$id = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT)));
$color = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'color', FILTER_SANITIZE_STRING)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)));
$stock = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_NUMBER_INT)));
$picture = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_URL)));


//SELECT statement
$sql = "UPDATE products SET"
        . " price = '$price',"
        . " stock = '$stock',"
        . " color = '$color',"
        . " picture = '$picture'"
        . " WHERE productid = $id";

//execute the query
$query = @$conn->query($sql);

//Handle errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $conn->close();
    require 'includes/footer.php';
    die("Selection failed: ($errno) $error.");
}
?>



<?php
//close database connection
$conn->close();

//display a confirmation message
echo "<h3 style='text-align:center'>You have successfully updated the product.</h3><br><br>";
require 'includes/footer.php';
