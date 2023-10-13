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
//checks if exercise is already added to the workout
$found=FALSE;
foreach ($_SESSION["exercise"] as &$entry){
    
    if ($entry["exercise"]===$_POST["ExerciseID"]){
        $found=TRUE;
    }

}
if ($found===FALSE){
    array_push($_SESSION["exercise"],$_POST["ExerciseID"]); //add the exercise id to the session exercise array
}

print_r($_SESSION);
header('Location: createworkout.php') //redirect the user back to the create workout page
?>