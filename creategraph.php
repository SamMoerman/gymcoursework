<?php
 include_once('connection.php');
 $stmt = $conn->prepare("SELECT * FROM pupilexercisetbl WHERE ExerciseID = :exerciseid ORDER BY Datev;");
 $stmt->bindParam(':exerciseid', $_POST["ExerciseID"]);
 $stmt->execute();
 
$dataPoints = array();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data = array(
        "y" => $row["Weightv"], "label" => $row["Datev"],
    );

    $dataPoints[] = $data;
 }

 $stmt1 = $conn->prepare("SELECT * FROM exercisetbl WHERE ExerciseID = :exerciseid ;");
 $stmt1->bindParam(':exerciseid', $_POST["ExerciseID"]);
 $stmt1->execute();
 while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
    $exercisename = ($row["ExerciseName"]);
 }
?>
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