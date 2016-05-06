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
	<?php
		#$link = mysqli_con
		$query = mysqli_query($dbc, "SELECT * FROM `". $product . "` WHERE `package_size` = '6 oz'");

		$row = mysqli_fetch_array($query, MYSQLI_NUM);

		if($row[0] != 0){

			while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
				echo "<p>" . $row['product_key'] . "</p>";
			}
		}
	?>

</body>
</html>