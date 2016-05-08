<?php
	include("dbconnect.php");
	include("selectdb.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title> Olap Gui</title>
</head>
<body>

	<button type = "button" id = "centralCube"> Central Cube </button>
	<form action = "" method = "Post">
		<button type = "button" id = "rollUp"> Roll Up </button>
		<input value = "hierarchy" type = "radio" name = "rollUpB"> Hierarchy
		<input value = "dimension" type = "radio" name = "rollUpB"> Radio
	</form>
	
	<form action = "" method = "Post">
		<button type = "button" id = "drillDown"> Drill Down </button>
		<input value = "Hierarchy" type = "radio" name = "drillDownB"> Hierarchy
		<input value = "Dimension" type = "radio" name = "drillDownB"> Dimension
	</form>

	<form action = "" method = "Post">
		<button type = "button" id = "slice"> Slice </button>
	</form>

	<form action = "" method = "Post">
		<button type = "button" id = "dice"> Dice </button>
	</form>
	<script>
		document.getElementById("centralCube").onclick = function(){
			centralCube();
		};

		document.getElementById("rollUp").onclick = function(){
			var i;

			var radios = document.getElementsByName("rollUpB");

			for(i = 0, length = radios.length; i < length;i++)
				if(radios[i].checked){
					rollUp(radios[i].value);
					break;
				}
		}

		document.getElementById("drillDown").onclick = function(){
			drillDown();
		}

		document.getElementById("slice").onclick = function(){
			slice();
		}

		document.getElementById("dice").onclick = function(){
			dice();
		}

		function centralCube() {
			alert("You have now accessed the Central Cube");
		}

		function rollUp(word){
			alert("You are rolling up by ".concat(word))
		}

		function drillDown(){
			alert("You are drilling down");
		}

		function slice(){
			alert("You are slicing");
		}

		function dice(){
			alert("You are dicing");
		}
	</script>
	<?php

		$query = mysqli_query($dbc, "SELECT COUNT(*) FROM `". $product . "`");

		$row = mysqli_fetch_array($query, MYSQLI_NUM);
	
		if($row[0] != 0){
			//selects a specific keyword to access
			$query = mysqli_query($dbc, "SELECT product_key, brand, day_of_week FROM `". $product . "`, `". $time . "` WHERE `day_of_week` = 'Tuesday' ");
			while($row = mysqli_fetch_assoc($query)){
				echo "<p>" . $row['product_key'] . " + " . $row['brand'] . "</p>";
				echo "<p>" . $row['day_of_week'] . "</p>";
			}	
		}
	?>

</body>
</html>