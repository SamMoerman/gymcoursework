<?php
session_start(); 
/*if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */
if (!isset($_SESSION["exercise"])){
    $_SESSION["exercise"]=array();
}
print_r($_SESSION);
print_r($_POST);
$index = array_search((int)$_POST["ExerciseID"],$_SESSION["exercise"]); // indexof element to remove
unset($_SESSION["exercise"][$index]); //remove the exercise id to the session exercise array
print_r($_SESSION);
header('Location: createworkout.php') //redirect the user back to the create workout page
?>