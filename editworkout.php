<?php
session_start(); 
/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

$stmt = $conn->prepare("SELECT * FROM wrkttbl;" );




while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo'<form action="exercise.php" method="post">';
    echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
    echo($row["ExerciseName"]); //display the exercisename on the screen
    echo("<input type='submit' value='Add Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>");
}