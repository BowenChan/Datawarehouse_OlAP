<?php
	include("dbconnect.php");
	include("selectdb.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title> Olap Gui</title>
</head>
<body onload = "javascript:setCentralCube()">


	<?php include("header.php");

	include("centralcube.php")
	?>


</body>
</html>