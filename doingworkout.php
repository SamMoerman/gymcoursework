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
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

include_once('connection.php');

if (isset($_POST['wrktID'])) {          //if coming from the start workout page
    $wrktID = $_POST['wrktID'];         //then set the workout ID
    $_SESSION["currentwrkt"]=$wrktID;
}else{                                  //if coming from inputting data page
    $wrktID=$_SESSION["currentwrkt"];   //then load the set workout ID
}
    try {
        // Query to get Exercise IDs from wrktexercisetbl
        $stmtOuter = $conn->prepare("SELECT ExerciseID FROM wrktexercisetbl WHERE WrktID = :wrktid");
        $stmtOuter->bindParam(':wrktid', $wrktID, PDO::PARAM_INT);
        $stmtOuter->execute();

        // Fetch all Exercise IDs
        $exerciseIDs = $stmtOuter->fetchAll(PDO::FETCH_COLUMN);

        // Use a single query to fetch all Exercise Names based on Exercise IDs
        $stmtInner = $conn->prepare("
            SELECT e.ExerciseID, e.ExerciseName, e.ExerciseImage
            FROM exercisetbl e
            WHERE e.ExerciseID IN (" . implode(',', $exerciseIDs) . ")
        ");
        $stmtInner->execute();

        // Fetch all Exercise IDs and Names
        $exerciseData = $stmtInner->fetchAll(PDO::FETCH_ASSOC);

        // Print Exercise IDs and Names
        foreach ($exerciseData as $exercise) {
            echo "Exercise ID: " . $exercise['ExerciseID'] . "<br>";
            echo "Exercise Name: " . $exercise['ExerciseName'];
            echo '<form action="recorddata.php" method="get">';
            echo '<input type="hidden" name="exerciseID" value="' . $exercise['ExerciseID'] . '">';
            echo '<button type="submit" class="btn btn-primary">Record Data</button>';
            echo("<br><img class='iconsm' src='images/".$exercise['ExerciseImage']."'>"); //displays each exercises corresponding image
            echo '</form><br>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    echo("<br><br><a href='startworkout.php'><button type='button'>Cancel Workout</button></a>"); //creates a back button that goes back to the start workout page

// Close the database connection
$conn = null;
?>