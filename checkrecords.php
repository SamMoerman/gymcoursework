<?php
include_once('connection.php');
session_start();

$stmt = $conn->prepare("SELECT * FROM pupilexercisetbl WHERE ExerciseID = :exerciseid AND UserID = :user ;");
$stmt->bindParam(':exerciseid', $_POST["ExerciseID"]);
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "Date: {$row['Datev']}<br>";
    echo "Weight: {$row['Weightv']}<br>";
    echo "Reps: {$row['Reps']}<br>";
    echo "<br>";
}

echo("<br><a href='records.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the records page
?>