<?php
 
 $stmt = $conn->prepare("SELECT * FROM pupilexercisetbl WHERE ExerciseID = :exerciseid ;");
 $stmt->bindParam(':exerciseid', $_POST["ExerciseID"]);
 $stmt->execute();
 

$dataPoints = array(
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    array("y" => $row["Weightv"], "label" => $row["Datev"]),
);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Push-ups Over a Week"
	},
	axisY: {
		title: "Number of Push-ups"
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