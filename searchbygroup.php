<?php
include_once('connection.php');

$q=$_GET["value"];#the valuse sent from dropdown on previous page


$stmt = $conn->prepare("select * from exerciseTbl where ExerciseTarget=:exercisetarget");

$stmt->bindParam(':exercisetarget', $q);
	
$stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo ($row["Surname"]."<br>");
    }
?>