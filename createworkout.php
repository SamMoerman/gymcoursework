<?php
session_start(); 
$_SESSION["edit"]=0;
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
echo("<a href='menu.php'><button type='button'>Back</button></a><br>"); //creates a back button that goes back to the menu page
echo("<input type='submit' value='FINISH'><br></form>");
$_SESSION["edit"]=0;
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
  // Function to load the page with a specified value.
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

  // Function to set the default value and load the page on window load.
  window.onload = function() {
    // Get the select element.
    var select = document.getElementById("page-selector");

    // Set the default value to "all".
    var defaultValue = "all";

    // Set the default selected option.
    for (var i = 0; i < select.options.length; i++) {
      if (select.options[i].value === defaultValue) {
        select.selectedIndex = i;
        break;
      }
    }

    // Load the page with the default value.
    loadPage('searchbygroup.php', defaultValue);
  };
</script>
<br>

<!-- creates a dropdown that lets the user select what filter they want to use -->
filter
 <select id="page-selector" onchange="loadPage('searchbygroup.php', this.value)">
    <option value="all">all</option>
    <option value="chest">chest</option>
    <option value="arms">arms</option>
    <option value="legs">legs</option>
    <option value="shoulders">shoulders</option>
  </select>

<div id="page-container">
</div>
</form>
</body>
</html>