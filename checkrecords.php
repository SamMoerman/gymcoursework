<?php
include_once('connection.php');
session_start();

if (!isset($_SESSION['loggedinuser']))//if no user is logged in
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];//then save this page
    header("Location:login.php");//and send user to the log in page
} 
//selects the date, weight, reps and exercise name from pupil exercisetbl for the selected exerciseID 
//and the logged in user from the entry that has the largest weight value for each unique rep value
$stmt = $conn->prepare("
    SELECT pe.Datev, pe.Weightv, pe.Reps, e.ExerciseName
    FROM pupilexercisetbl pe
    JOIN exercisetbl e ON pe.ExerciseID = e.ExerciseID
    WHERE pe.ExerciseID = :exerciseid
    AND pe.UserID = :user
    AND (pe.Reps, pe.Weightv) IN (
        SELECT Reps, MAX(Weightv) as MaxWeight
        FROM pupilexercisetbl
        WHERE ExerciseID = :exerciseid
        AND UserID = :user
        GROUP BY Reps
    )
");
$stmt->bindParam(':exerciseid', $_POST["ExerciseID"]);
$stmt->bindParam(':user', $_SESSION['loggedinuser']);
$stmt->execute();

$exerciseNamePrinted = false; // Variable to track if ExerciseName has been printed

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Print ExerciseName only once at the top
    if (!$exerciseNamePrinted) {
        echo "Exercise Name: {$row['ExerciseName']}<br><br>";
        $exerciseNamePrinted = true; // Set the variable to true once ExerciseName is printed
    }

    // Print other details for each entry
    echo "Date: {$row['Datev']}<br>";
    echo "Weight: {$row['Weightv']}<br>";
    echo "Reps: {$row['Reps']}<br>";
    echo "<br>";
}

echo("<a href='records.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the records page
?>