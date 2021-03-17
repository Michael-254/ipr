
<?php
$dataPoints = array(
	array("x"=> 1, "y"=> $it, "label"=> "IT"),
	array("x"=> 2, "y"=> $acc, "label"=> "Accounts"),
	array("x"=> 3, "y"=> $hr, "label"=> "Human Resources"),
	array("x"=> 4, "y"=> $com, "label"=> "Communications"),
	array("x"=> 5, "y"=> $miti, "label"=> "Miti Magazine"),
	array("x"=> 6, "y"=> $op, "label"=> "Operations"),
	array("x"=> 7, "y"=> $fore, "label"=> "Forestry")
);

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Pending IPRs for Review per Department "
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 90%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
