<?php
session_start(); 
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
}

if (!isset($_SESSION["exercise"])){
    $_SESSION["exercise"]=array();
}
$found=FALSE;
foreach ($_SESSION["exercise"] as &$entry){
    
    if ($entry["exercise"]===$_POST["ExerciseId"]){
        $found=TRUE;
    }

}
if ($found===FALSE){
    array_push($_SESSION["exercise"],array("exercise"=>$_POST["ExerciseId"]));
}

print_r($_SESSION);
header('Location: createworkout.php')
?>