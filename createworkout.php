<?php
/* session_start(); 
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
    
</head>
<body>

<?php
include_once('connection.php');
if (isset($_SESSION['exercise'])){
    echo "there are ".count($_SESSION["exercise"])." exercises in your workout";
}
$stmt = $conn->prepare("SELECT * FROM exercisetbl");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo'<form action="addexercise.php" method="post">';
    echo($row["ExerciseName"]);
    echo("<input type='submit' value='Add Exercise'><input type='hidden' name='ExerciseID' value=".$row['ExerciseID']."><br></form>");
}

?><!-- <a href = "checkout.php">Checkout</a> -->
</form>
</body>
</html>