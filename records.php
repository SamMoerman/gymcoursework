<!DOCTYPE html>
<html>
<head>
    
    <title>create a workout</title>
    <!--makes icons small-->
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

if (!isset($_SESSION['loggedinuser']))//if there is no logged in user
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];//save this page
    header("Location:login.php");//and send user to log in page
} 

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