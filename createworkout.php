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



echo'<form action="makeworkout.php" method="post">';
echo 'Name: <input type="text" name="WrktName" value="WORKOUT NAME"><br>'; //creates text box to input workout name
echo("<input type='submit' value='FINISH'><br></form>");
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
?>
<script>
function loadPage(page, value) {
  // Get the div element where the page will be loaded.
  var div = document.getElementById("page-container");

  // Create a new XMLHttpRequest object.
  var xhr = new XMLHttpRequest();

  // Open a GET request to the selected page, passing the value as a query parameter.
  xhr.open("GET", page + "?value=" + value);

  // Set the callback function to be executed when the request is completed.
  xhr.onload = function() {
    // If the request was successful, set the content of the div element to the response.
    if (xhr.status === 200) {
      div.innerHTML = xhr.responseText;
    } else {
      // If the request was not successful, show an error message.
      div.innerHTML = "Error: " + xhr.statusText;
    }
  };
  // Send the request.
  xhr.send();
}
</script>

 <select id="page-selector" onchange="loadPage('searchbygroup.php', this.value)">
    <option disabled selected value> -- select an option -- </option> # forces selection from list
    <option value="chest">chest</option>
    <option value="arms">arms</option>
    <option value="all">all</option>
   
  </select>


<?php


?>
<div id="page-container">
</div>
</form>
</body>
</html>