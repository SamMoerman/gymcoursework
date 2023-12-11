<!DOCTYPE html>
<html>
<head>
    
    <title>create a workout</title>
    <!--temp styling for testing-->
    <style>
        .iconsm{
            height:50px;
        }
    </style>
</head>
<body>

<?php
include_once('connection.php');
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

$stmt = $conn->prepare("SELECT * FROM exercisetbl ");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo'<form action="checkrecords.php" method="post">';
        echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
        echo($row["ExerciseName"]); //display the exercisename on the screen
        echo("<input type='submit' value='check records'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>"); 
    }

    echo("<br><a href='menu.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the menu page

?>