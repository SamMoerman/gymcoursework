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
print_r($_POST);
foreach ($_SESSION["exercise"] as &$entry){
    echo("<br>");
    print_r($entry);
    
    if ($entry===$_POST["ExerciseID"]){
        $found=TRUE;
    }

}
echo($found);

if ($found===FALSE){
    #$newex=array("WrktID"=>(int)$_SESSION["currentwrkt"], "ExerciseID"=>$_POST["ExerciseID"]);
    array_push($_SESSION["exercise"], $_POST["ExerciseID"]);//add the exercise id to the session exercise array
}

print_r($_SESSION);
if ($_SESSION["edit"]==0){
    header('Location: createworkout.php');//redirect the user back to the create workout page
}else{
    header('Location: loadworkout.php');//redirects the user back to the edit workout page
}
?>