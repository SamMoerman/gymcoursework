<?php
 include_once('connection.php');
 session_start();
 //select each of the data points from the database that are from the selected exercise and by the logged in user and put them in date order
 $stmt = $conn->prepare("SELECT * FROM pupilexercisetbl WHERE ExerciseID = :exerciseid AND UserID = :user ORDER BY Datev;");
 $stmt->bindParam(':exerciseid', $_POST["ExerciseID"]);
 $stmt->bindParam(':user', $_SESSION['loggedinuser']);
 $stmt->execute();

 //put all of the data points that are going to be plotted into an array
$dataPoints = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data = array(
        "y" => $row["Weightv"], "label" => $row["Datev"],
    );

    $dataPoints[] = $data;
 }

 //retrieves the name of the exercise that has been selected from the database so it can be printed onto the graph
 $stmt1 = $conn->prepare("SELECT * FROM exercisetbl WHERE ExerciseID = :exerciseid ;");
 $stmt1->bindParam(':exerciseid', $_POST["ExerciseID"]);
 $stmt1->execute();
 while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
    $exercisename = ($row["ExerciseName"]);
 }
 echo("<br><a href='graphs.php'><button type='button'>Back</button></a>"); //creates a back button that goes back to the graphs page
?>
<!-- creates the graph using the template from canvasJS.com -->
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "<?php echo $exercisename ?>"
	},
	axisY: {
		title: "Weight / kg"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>