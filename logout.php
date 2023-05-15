<?php
session_start();
//if user is logged in then log current user out
if(isset($_SESSION['loggedinuser']))
{
    unset($_SESSION['loggedinuser']);
}
//sends user back to the workout screen
header("Location: menu.php");
?>
