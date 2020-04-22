<?php
//start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//link database page
require_once('includes/database.php');

$login_status = '';
if (isset($_SESSION['login_status'])) {
    $login_status = $_SESSION['login_status'];
}

//initialize message variable
$message = "";

?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Log In</title>
        
        <link href="public/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body style="background-image: url('images/background1.png');">
        <div class="centered" style="text-align: center; border-radius: 25px; background-color: white; width: 450px; margin:0 auto; box-shadow: 5px 10px rgba(81, 81, 81, .8);">
            <?php
                //user's last login attempt succeeded
                if($login_status == 1) {
                    echo "<p> You are logged in as " . $_SESSION['login'] . ".</p>";
                    echo "<a class='buttonstyle' href='logout.php'>Logout</a>&nbsp;&nbsp";
                    echo "<a class='buttonstyle' onclick='window.history.back()'>Cancel</a>";
                    echo "<p align='center'>&copy;2018. Not affiliated with Colgate&reg;, but would like to be.</p>";
                    exit();
                }
                
                //user has just registered
                if($login_status == 3) {
                    echo "<p>Thanks for registering. Your account has been created.</p>";
                    echo "<a class='buttonstyle' href='index.php'>Home</a>&nbsp;&nbsp;";
                    echo "<a class='buttonstyle' href='logout.php'>Logout</a>";
                    echo "<p align='center'>&copy;2018. Not affiliated with Colgate&reg;, but would like to be.</p>";
                    $_SESSION['login_status'] = 1;
                    exit();
                }
                
                //user's last login attempt failed
                if($login_status == 2) {
                    $message = "Username or password invalid. Please try again.";
                }
                
                //from checkout if not logged in
                if($login_status == 4) {
                    $message = "Please log in to check out.";
                }
            ?>
            
            
            <div style="width: 400px;">
                <br>
                <p style="margin:0 auto; transform: translateX(20px)"><?php echo $message ?></p>
                <form style="width:450px" action="loginlogic.php" method="post">
                    <table style="transform: translatex(20px)">
                        <tr>
                            <td><p>Username:</p></td>
                            <td><input class='inputbar' type='text' name='username' value='' required /></td>
                        </tr>
                        <tr>
                            <td><p>Password:</p></td>
                            <td><input class='inputbar' type='password' name='password' value='' required /></td>
                        </tr>
                            
                    </table>
                    <input style='left:50%' type='submit' class='buttonstyle' value='Log in'>
                </form>
            </div>
            <p>-------------------- OR --------------------</p>
            <input type='button' class='buttonstyle' onclick="window.location.href='signup.php'" value='Sign Up'>
            <input type="button" class='buttonstyle' onclick='window.history.back()' value='Cancel'>
            <p align="center">&copy;2018. Not affiliated with Colgate&reg;, but would like to be.</p>
        </div>
    </body>
</html>