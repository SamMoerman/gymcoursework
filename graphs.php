<!DOCTYPE html>
<html>
<head>
    
    <title>create a workout</title>
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


if (!isset($_SESSION['loggedinuser'])) //if the user is not logged in
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];//store the page that the user is being sent from
    header("Location:login.php");//and send them to the login page
} 

$stmt = $conn->prepare("SELECT * FROM exercisetbl ");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo'<form action="creategraph.php" method="post">';
        echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
        echo($row["ExerciseName"]); //display the exercisename on the screen
        echo("<input type='submit' value='view graph'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>"); 
    }

    echo("<br><a href='menu.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the menu page

?>