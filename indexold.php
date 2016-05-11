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
<body>



	<?php include("header.php");
	$_SESSION["attributes"] = array("Time", "Product", "Store");
	$_SESSION['time'] = 1;
	$_SESSION['product'] = 7;
	$_SESSION['store'] = 4;
	$_SESSION['promotion'] = 1;
	$_SESSION['timeArray'] = array("date", "day_of_week", "day_number_in_month", "week_number_in_year", "week_number_overall","Month", "quarter", "fiscal_period", "year");
	$_SESSION['productArray'] = array("description", "full_description", "sku_number", "package_size", "brand", "subcategory", "category", "department", "package_type", "diet_type");
	$_SESSION['storeArray'] = array("name", "store_number","store_street_address", "city", "store_county", "store_state", "store_zip","sales_district", "sales_region");
	$_SESSION['promotion'] = array("promotion_name","price_reduction_type","ad_type", "display_type", "coupon_type", "ad_media","display_provider");
	include("centralcube.php");

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