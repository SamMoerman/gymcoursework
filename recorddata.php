
<?php
session_start();

/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */

/////FOR TESTING ONLY///////



/* $_SESSION['loggedinuser']=1; */



///////////////////////////


include_once('connection.php');

// Check if exerciseID is set in the query string
if (isset($_GET['exerciseID'])) {
    $exerciseID = $_GET['exerciseID'];

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['weight']) && isset($_POST['reps'])) {
            $weight = $_POST['weight'];
            $reps = $_POST['reps'];
            $date = date("Y-m-d H:i:s");  // Get the current date and time
    
            try {
                // Insert data into the database
                $stmt = $conn->prepare("INSERT INTO pupilexercisetbl (UserID, WrktID, ExerciseID, Datev, Weightv, Reps) VALUES (:userid, :wrktid, :exerciseID, NOW(), :weightv, :reps)");
                $stmt->bindParam(':userid', $_SESSION['loggedinuser'], PDO::PARAM_INT);
                $stmt->bindParam(':wrktid', $_SESSION["currentwrkt"], PDO::PARAM_INT);
                $stmt->bindParam(':exerciseID', $exerciseID, PDO::PARAM_INT);
                $stmt->bindParam(':weightv', $weight, PDO::PARAM_INT);
                $stmt->bindParam(':reps', $reps, PDO::PARAM_INT);
                $stmt->execute();
  

                echo "Data saved successfully!";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Data</title>
</head>
<body>
    <h2>Record Data</h2>

    <form method="post" action="">
        <label for="weight">Weight (kgs):</label>
        <input type="number" id="weight" name="weight" required min="0">

        <label for="reps">Reps:</label>
        <input type="number" id="reps" name="reps" required min="1">

        <button type="submit">Save</button>
    </form>

    <form method="post" action="doingworkout.php">
        
        <button type="submit">Back to Exercise List</button>
    </form>

</body>
</html>

<?php

} else {
    // Redirect if exerciseID is not set
    header("Location: doingworkout.php");
    exit();
}

// Close the database connection
$conn = null;
?>