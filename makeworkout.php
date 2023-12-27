<?php
session_start();
include_once('connection.php');

//put workout into wrkttbl
if ($_SESSION["exercise"]){
    $stmt1 = $conn->prepare("INSERT INTO WrktTbl(WrktID,WrktName, UserID)VALUES
    (null,:WrktName,:user)");
    $stmt1->bindParam(':WrktName', $_POST["WrktName"]);
    $stmt1->bindParam(':user', $_SESSION['loggedinuser']);
    $stmt1->execute();
    $last_id = $conn->lastInsertId();
    $stmt1->closeCursor();

    //for each exercise in the workout put the exercise into wrktexercisetbl
    foreach ($_SESSION["exercise"] as &$entry){
        $stmt1 = $conn->prepare("INSERT INTO WrktexerciseTbl(WrktID,ExerciseID)VALUES
        (:WrktID,:ExerciseID)");
        $stmt1->bindParam(':WrktID', $last_id);
        $stmt1->bindParam(':ExerciseID', $entry);
        $stmt1->execute();
        $stmt1->closeCursor();
    }
}

header('Location: menu.php') //redirect the user back to the menu page
?>