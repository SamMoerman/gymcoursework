<?php
include_once('connection.php');
session_start();

// Check if wrktid is set
if (isset($_POST['wrktID'])) {
    $wrktID = $_POST['wrktID'];

    try {
        // Prepare SQL query to retrieve ExerciseName, Datev, Weightv, and Reps for the most recent Datev for each ExerciseID
        $stmt = $conn->prepare("
            SELECT e.ExerciseName, pe.Datev, pe.Weightv, pe.Reps
            FROM pupilexercisetbl pe
            JOIN exercisetbl e ON pe.ExerciseID = e.ExerciseID
            WHERE pe.WrktID = :wrktid
            AND (pe.ExerciseID, pe.Datev) IN (
                SELECT ExerciseID, MAX(Datev) as MaxDate
                FROM pupilexercisetbl
                WHERE WrktID = :wrktid
                GROUP BY ExerciseID
            )
        ");

        $stmt->bindParam(':wrktid', $wrktID);
        $stmt->execute();

        // Fetch and print the results
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Print Exercise Name, Datev, Weight, and Reps for each entry
            echo "Exercise Name: {$row['ExerciseName']}<br>";
            echo "Date: {$row['Datev']}<br>";
            echo "Weight: {$row['Weightv']}<br>";
            echo "Reps: {$row['Reps']}<br>";
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

echo("<br><a href='lastworkout.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the last workout page

// Close the database connection
$conn = null;
?>