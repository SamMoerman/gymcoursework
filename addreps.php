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

$stmt = $conn->prepare("SELECT * FROM pupilexercisetbl WHERE ExerciseID = :exercise AND UserID = :user ;" );  // selects the user who is trying to log in from the database
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->bindParam(':exercise', $entry);

$stmt = $conn->prepare("SELECT * FROM pupilexercisetbl");
$stmt->execute();

print_r($_SESSION);
header('Location: createworkout.php') //redirect the user back to the create workout page
?>