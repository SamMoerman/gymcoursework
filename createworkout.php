<?php
session_start(); 
/*
if (!isset($_SESSION['loggedinuser']))
{   
    $_SESSION['backURL'] = $_SERVER['REQUEST_URI'];
    header("Location:login.php");
} */
?>
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



/////FOR TESTING ONLY///////



$_SESSION['loggedinuser']=1;



///////////////////////////


echo 'Name: <input type="text" name="name" value="WORKOUT NAME"><br>';

print_r($_SESSION);
include_once('connection.php');
if (isset($_SESSION['exercise'])){
    echo "there is ".count($_SESSION["exercise"])." exercises in your workout";
    //run query to pick up name of exercise from id
    foreach ($_SESSION["exercise"] as &$entry){
        $stmt = $conn->prepare("SELECT * FROM exercisetbl WHERE ExerciseID =:exercise ;" );  // selects the exercise names that correspond with the exerciseID s in the workout
        $stmt->bindParam(':exercise', $entry);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))  //prints out each of the exercise names that are currently in the workout
        { 
            echo "<hr />";
            echo ($row["ExerciseName"]);
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM exercisetbl");
$stmt->execute();
$stmt1 = $conn->prepare("SELECT * FROM pupilexercisetbl");
$stmt1->execute();

if (!isset($_SESSION["exercise"])){
    $_SESSION["exercise"]=array();
}

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
echo'<form action="makeworkout.php" method="post">';
echo("<input type='submit' value='FINISH'><input type='hidden' name='workoutID' value=".$row['ExerciseID']."<br></form>");
?>
</form>
</body>
</html>