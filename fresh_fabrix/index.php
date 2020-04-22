<?php
    $page_title = "Home";

    //include header
    include ('includes/header.php');
    
    
?>
<div class="tabler">
    <img class="indexpictures" width="100%" src="images/opener.jpg">
</div>

<div style="text-align: center;" class="tabler">
    <a href="pantstable.php"><div class="darken">
        <img class="indexpictures" height="500px" src="images/pants1.jpg">
        <h2 class="centered" align="center" class="colgate" style="font-size:30pt; color:white">Pants<br></h2>
    </div></a>
    <a href="shirtstable.php"><div class="darken">
        <img class="indexpictures" height="500px" src="images/shirts1.jpg">
        <h2 class="centered" align="center" class="colgate" style="font-size:30pt; color:white">Shirts<br></h2>
    </div></a>
    <a href="hatstable.php"><div class="darken">
        <img class="indexpictures" height="500px" src="images/hat2.jpg">
        <h2 class="centered" align="center" class="colgate" style="font-size:30pt; color:white">Hats<br></h2>
    </div></a>
</div>

<?php
include ('includes/footer.php');
