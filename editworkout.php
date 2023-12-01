<?php
session_start(); 
$_SESSION["edit"]=1;
/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

/////FOR TESTING ONLY///////



$_SESSION['loggedinuser']=1;



///////////////////////////


include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM wrkttbl WHERE UserID = :user ;");
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) //prints out each of the users workouts and an edit button next to each one
{
    echo'<form action="loadworkout.php" method="post">';
    echo($row["WrktName"]); //display the exercisename on the screen
    echo("<input type='submit' value='edit'><input type='hidden' name='wrktID' value=".$row['WrktID']."<br></form>");
}

echo("<br><a href='menu.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the menu page

/* while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo'<form action="exercise.php" method="post">';
    echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
    echo($row["ExerciseName"]); //display the exercisename on the screen
    echo("<input type='submit' value='Add Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>");
} */