<?php
include_once('db_fuggvenyek.php');



$result = mysqli_query(adatbazis_csatlakozas(),"SELECT SUM(egyenleg) AS összeg, nev FROM folyoszamla, ugyfel WHERE id=folyoszamla.ugyfelID GROUP BY id;");

$dataPoints = array(

);
while ($row = mysqli_fetch_assoc($result)) {
 array_push($dataPoints,array("label"=>$row['nev'], "y"=>$row['összeg']));
}

?>
<html>
<head>



<meta charset="UTF-8">
<link rel="stylesheet" href="styles.css">
<title>The Bank</title>

<script>
window.onload = function() {


var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Ügyfeleink közötti vagyonelolszlás"
	},
	subtitles: [{
		text: "összesítve folyószámlák alapján"
	}],
	data: [{
		type: "pie",

		indexLabel: "{label} - {y}Ft",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>

</head>
<body>
<div class='headline'>The Bank</div>
<div class="topnav">
  <a class="active">Kezdőlap</a>
  <a href="ugyfelek.php">Ügyfelek</a>
  <a href="folyoszamlak.php">Folyószámlák</a>
  <a href="atutalas.php">Átutalások</a>
  <a href="kolcson.php">Kölcsönök</a>
</div>
<br>
<hr color="black">
<br>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>
