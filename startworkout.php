<?php
session_start(); 
/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */


//user selects the workout that they want to complete

include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM wrkttbl WHERE UserID = :user ;");
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) //prints out each of the users workouts and an edit button next to each one
{
    echo'<form action="doingworkout.php" method="post">';
    echo($row["WrktName"]); //display the workout name on the screen
    echo("<input type='submit' value='start workout'><input type='hidden' name='wrktID' value=".$row['WrktID']."<br></form>");
}

echo("<br><a href='menu.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the menu page

