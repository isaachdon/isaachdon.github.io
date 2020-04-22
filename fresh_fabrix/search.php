<?php
$page_title = "Search Results";

require_once ('includes/header.php');

//link database page
require_once('includes/database.php');

//import input from allproducts.php search
$input = filter_input(INPUT_GET, "input", FILTER_SANITIZE_STRING);

//check if search is contained within brackets
if (substr($input, 0, 1) == '[' AND substr($input, -1, 1) == ']') {
    $search = explode(" ", substr($input, 1, strlen($input) - 2));
    
    //construct sql statement
    $sql = "SELECT * FROM products WHERE 1";
    foreach ($search as $term) {
        $sql .= "  AND CONCAT(productid,type,color) LIKE '%$term%'";
    }
} else {
    //make array out of all values searched
    $search = explode(" ", $input);

    //construct sql statement
    $sql = "SELECT * FROM products WHERE 0";
    foreach ($search as $term) {
        $sql .= " OR CONCAT(productid,type,color) LIKE '%$term%'";
    }
}

//execute the query
$query = $conn->query($sql);

//handle operation errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    die("Connection to database failed:($errno)$errmsg.");
}
?>

<h1 align="center" style="font-size:40pt">'<?php echo $input; ?>'</h1>

<?php
if (($query->num_rows) == 0) {
    echo "<p style='text-align:center'>Your search did not return any results</p>";
}
?>

<div style="text-align:center">
    <?php
    while (($row = $query->fetch_assoc()) !== NULL) {
        echo "<a href='details.php?id=", $row['productid'], "'><div class='darken' style='padding:20px; display:inline-block'>";
        echo "<img style='height:300px' src='", $row['picture'], "'><br>";
        echo "$", $row['price'];
        echo "</div></a>";
    }
    ?>
</div>

<?php
require('includes/footer.php');
?>