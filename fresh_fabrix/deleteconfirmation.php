<?php
$page_title = "Deletion Successful";
require 'includes/header.php';
require_once('includes/database.php');


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//SELECT statement
$sql = "DELETE FROM products WHERE productid=$id";

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
echo "<h3 style='text-align:center'>You have successfully deleted the product from the database.</h3><br><br>";

require 'includes/footer.php';
