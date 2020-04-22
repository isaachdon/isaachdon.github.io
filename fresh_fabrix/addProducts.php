<?php

$page_title = "Add Product";

//connect header and database
require 'includes/header.php';
require_once('includes/database.php');

//if not an admin, tell the user they are not authorized for this page
if($role == 1) {
    echo "<h1 style='text-align:center'>You are not authorized for this page</h1>";
    include("includes/footer.php");
    exit;
}
?>
<h1 align="center" style="font-size:40pt">Add new products</h1>
<form action="insertproduct.php" method="post">
    <table align="center">
       <tr>
            <td>Color: </td>
            <td><input name="color" type="text" required /></td>
        </tr>
        <tr>
            <td>Type:</td>
            <td>
                <select name="type">
                    <option value="shirt">Shirt</option>
                    <option value="pants">Pants</option>
                    <option value="hat">Hat</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Price: </td>
            <td><input name="price" type="float" required /></td>
        </tr>
         <tr>
            <td>Stock:</td>
            <td><input name="stock" type="number" size="40" required /></td>
        </tr>
         <tr>
            <td>Image:</td>
            <td><input name="picture" type="text" size="40" required /></td>
        </tr>

    </table>
    <div style="text-align: center">
        <input class="normalbuttons" type="submit" value="Add Product" />
        <input class="normalbuttons" type="button" value="Cancel" onclick="window.history.back()" />
    </div>
</form>

<?php

require 'includes/footer.php';
?>
