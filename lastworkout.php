<?php
include_once('connection.php');
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

/////FOR TESTING ONLY///////



$_SESSION['loggedinuser']=1;



///////////////////////////


$stmt = $conn->prepare("SELECT * FROM wrkttbl WHERE UserID = :user ;");
$stmt->bindParam(':user', $_SESSION['loggedinuser']); 

$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo'<form action="lastworkoutspecific.php" method="post">';
    echo($row["WrktName"]); //display the workout name on the screen
    echo("<input type='submit' value='view data'><input type='hidden' name='wrktID' value=".$row['WrktID']."<br></form>");
}

echo("<br><a href='menu.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the menu page
?>