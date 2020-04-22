<?php
$page_title = "Shirts";
require 'includes/header.php';
?>

<h1 align="center" style="font-size:40pt">Shirts</h1>
    <?php
        //link database page
        require_once('includes/database.php');
        
        //select statement
        $sql = "SELECT * FROM products WHERE type='shirt'";

        //execute the query
        $query = $conn->query($sql);
        
        //handle operation errors
        if (!$query){
            $errno=$conn->errno;
            $errmsg=$conn->error;
            die("Connection to database failed:($errno)$errmsg.");
        }
    ?>
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
        // clean up resultsets when we're done with them!
        $query->close();

        // close the connection.
        $conn->close();
	?>
</table>

<?php
include ('includes/footer.php');

