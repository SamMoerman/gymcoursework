<?php
include_once('connection.php');
session_start();
$q=$_GET["value"];#the values sent from dropdown on previous page
echo($q);

if ($q=="all")
{
    $stmt = $conn->prepare("SELECT * FROM exercisetbl ");
}else{
    $stmt = $conn->prepare("SELECT * FROM exercisetbl where ExerciseTarget=:exercisetarget");
    $stmt->bindParam(':exercisetarget', $q);
}
    $stmt->execute();
    
    if (!isset($_SESSION["exercise"])){
        $_SESSION["exercise"]=array();
    }
$exerciselist=[];
if ($_SESSION["edit"]==1){
foreach($_SESSION["exercise"] as $entry){

    array_push($exerciselist,$entry["ExerciseID"]);
}
}
print_r($exerciselist);
echo("<br>s");
print_r($_SESSION);
if ($_SESSION["edit"]==1){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        
        if(!in_array($row["ExerciseID"],$exerciselist)){ //exercise is not in workout, display add exercise button
            echo'<form action="addexercise.php" method="post">';
            echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
            echo($row["ExerciseName"]); //display the exercisename on the screen
            echo("<input type='submit' value='Add Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>"); 
        }else{ //exercise is already in workout, display remove button
            echo'<form action="removeexercise.php" method="post">';
            echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
            echo($row["ExerciseName"]); //display the exercisename on the screen
            echo("<input type='submit' value='Remove Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."<br></form>");
        }
    }
}
if ($_SESSION["edit"]==0){
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        
        if(!in_array($row["ExerciseID"],$_SESSION["exercise"])){ //exercise is not in workout, display add exercise button
            echo'<form action="addexercise.php" method="post">';
            echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
            echo($row["ExerciseName"]); //display the exercisename on the screen
            echo("<input type='submit' value='Add Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>"); 
        }else{ //exercise is already in workout, display remove button
            echo'<form action="removeexercise.php" method="post">';
            echo("<img class='iconsm' src='images/".$row['ExerciseImage']."'>"); //displays each exercises corresponding image
            echo($row["ExerciseName"]); //display the exercisename on the screen
            echo("<input type='submit' value='Remove Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."<br></form>");
        }
    }
}
?>