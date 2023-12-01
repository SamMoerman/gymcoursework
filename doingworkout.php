<?php
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

include_once('connection.php');

if (isset($_POST['wrktID'])) {
    $wrktID = $_POST['wrktID'];

    try {
        // Query to get Exercise IDs from wrktexercisetbl
        $stmtOuter = $conn->prepare("SELECT ExerciseID FROM wrktexercisetbl WHERE WrktID = :wrktid");
        $stmtOuter->bindParam(':wrktid', $wrktID, PDO::PARAM_INT);
        $stmtOuter->execute();

        // Fetch all Exercise IDs
        $exerciseIDs = $stmtOuter->fetchAll(PDO::FETCH_COLUMN);

        // Use a single query to fetch all Exercise Names based on Exercise IDs
        $stmtInner = $conn->prepare("
            SELECT e.ExerciseID, e.ExerciseName
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
            echo '</form><br>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>