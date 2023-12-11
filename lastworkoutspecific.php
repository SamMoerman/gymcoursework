<?php
include_once('connection.php');
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

if (isset($_POST['wrktid'])) {
    $wrktID = $_POST['wrktid'];

    try {
        $stmt = $conn->prepare("
            SELECT *
            FROM pupilexercisetbl
            WHERE ExerciseID = :exerciseid
            ORDER BY Datev DESC
            LIMIT 1
        ");
        $stmt->bindParam(':exerciseid', $wrktID);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Print out each column's value
            foreach ($row as $columnName => $value) {
                echo "$columnName: $value<br>";
            }
            echo "<br>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close the database connection
$conn = null;
?>