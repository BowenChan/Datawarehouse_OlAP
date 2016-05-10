<?php
	include("dbconnect.php");
	include("selectdb.php");
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> Olap Gui</title>
</head>
<body onload = "javascript:setCentralCube()">



	<?php include("header.php");
	$_SESSION["attributes"] = array("Time", "Product", "Store");
	$_SESSION['time'] = "day_of_week";
	$_SESSION['product'] = "department";
	$_SESSION['store'] = "store_county";
	$_SESSION['promotion'] = "price_reduction_type";
	include("centralcube.php")

	/*
	      echo "<tr>";
                
                echo "<td>" .$row["store_county"]. "</td>";
                
                echo "<td>" .$row["department"]. "</td>";
                
                echo "<td>" .$row["day_of_week"]. "</td>";
                
                echo "<td>" .$row["Dollar_Sales"]. "</td>";
                
                echo "</tr>";
                */
	?>


</body>
</html>