
<?php
	#Sets up Database and tables
	$dbname = "datawarehouse";
	$product = "Product";
	$promotion = "Promotion";
	$salesFact = "SalesFact";
	$store = "Store";
	$time = "Time";
	$selected = mysqli_select_db($dbc, $dbname);
?>