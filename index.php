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
		/**$query2 = mysqli_query($dbc, "SELECT
	`description`,
	`city`,
    `day_of_week`,
    `store_county`,
    sum(Sales.dollar_sales) AS `Dollar_Sales`
    FROM
    `". $product ."`" . "as P,
   	 `".  $store . "`" . "as S,
    `". $time . "`" . "as T,
    `" . $salesFact ."` as Sales
	WHERE
	
	Sales.product_key = P.product_key AND
    Sales.store_key = S.store_key AND
    T.time_key AND Sales.time_key 
    
    
GROUP BY
	P.description,
    S.city,
    S.store_county,
    T.day_of_week
    ");*/

    	//Checks if there are any data inside the table
		$query = mysqli_query($dbc, "SELECT COUNT(*) FROM `". $product . "`");

		$row = mysqli_fetch_array($query, MYSQLI_NUM);
	
		if($row[0] != 0){
			//selects a specific keyword to access
			$query = mysqli_query($dbc, "SELECT product_key FROM `". $product . "`");
			while($row = mysqli_fetch_assoc($query)){
				echo "<p>" . $row['product_key'] . "</p>";
			}	
		}
	?>

</body>
</html>