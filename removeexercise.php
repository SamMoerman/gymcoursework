<?php
session_start(); 

if (!isset($_SESSION['loggedinuser']))//if no user is logged in
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];//save this page
    header("Location:login.php");//and send the user to the log in page
} 

if (!isset($_SESSION["exercise"])){
    $_SESSION["exercise"]=array();
}
print_r($_SESSION);
print_r($_POST);
$index = array_search((int)$_POST["ExerciseID"],$_SESSION["exercise"]); // indexof element to remove
unset($_SESSION["exercise"][$index]); //remove the exercise id to the session exercise array
print_r($_SESSION);
if ($_SESSION["edit"]==0){
    header('Location: createworkout.php');//redirect the user back to the create workout page
}else{
    header('Location: loadworkout.php'); //redirect the user back to the load workout page
}

?>