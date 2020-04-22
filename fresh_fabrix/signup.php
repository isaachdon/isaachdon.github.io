<?php
//start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//link database page
require_once('includes/database.php');

$firstname = "";
$lastname = "";
$username = "";
$password = "";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        
        <link href="public/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-image: url('images/background1.png');">
        <div class="centered" style="text-align: center; border-radius: 25px; background-color: white; width: 450px; margin:0 auto; box-shadow: 5px 10px rgba(81, 81, 81, .8);">
            <div>
                <form method="post" action="newuser.php" >
                    <table>
                            <tr>
                                <td><p>First Name:</p></td>
                                <td><p><input class="inputbar" type="text" name="firstname" value="<?php echo $firstname ?>" required /></p></td>
                            </tr>
                            <tr>
                                <td><p>Last Name:</p></td>
                                <td><input class="inputbar" type="text" name="lastname" value="<?php echo $lastname ?>" required /></td>
                            </tr>
                            <tr>
                                <td><p>Username:</p></td>
                                <td><input class="inputbar" type="text" name="username" value="<?php echo $username ?>" required /></td>
                            </tr>
                            <tr>
                                <td><p>Password:</p></td>
                                <td><input class="inputbar" type="password" name="password" value="<?php echo $password ?>" required /></td>
                            </tr>
                    </table>
                    
                    <!-- buttons for submitting or canceling -->
                    <div style="text-align:center">
                        <input style="display:inline-block" type="submit" class="buttonstyle" value="Submit">
                        <input style="display:inline-block" type="button" class="buttonstyle" onclick="window.history.back()" value="Cancel">
                    </div>
                </form>
            </div>
            
            <p align="center">&copy;2018. Not affiliated with Colgate&reg;, but would like to be.</p>
        </div>
    </body>
</html>