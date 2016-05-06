<?php
	include("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title> Olap Gui</title>
</head>
<body>
	<?php
		$query = mysqli_query($conn, "SELECT * FROM `Product` WHERE `package_size` = `6 oz`");
		$row = mysqli_fetch_array($q, MYSQLI_NUM);
		if($row[0] != 0){
			while($row = mysqli_fetch_array($q, MYSQLI_ASSOC)){
				echo "<p>" . $row[product_key] . "</p>";
			}
		}
	?>

</body>
</html>