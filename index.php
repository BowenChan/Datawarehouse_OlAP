<!DOCTYPE html>
<?php
	#Setting up the session
	session_start();

	#Setting the dynamic session variables
	$_SESSION['allAttributes'] = array("store", "product", "time", "promotion");
	$_SESSION['attributes'] = array("store", "product", "time");
	$_SESSION['time'] = 1;
	$_SESSION['product'] = 7;
	$_SESSION['store'] = 4;
	$_SESSION['promotion'] = 1;
	$_SESSION['timeArray'] = array("date", "day_of_week", "day_number_in_month", "week_number_in_year", "week_number_overall","Month", "quarter", "fiscal_period", "year");
	$_SESSION['productArray'] = array("description", "full_description", "sku_number", "package_size", "brand", "subcategory", "category", "department", "package_type", "diet_type");
	$_SESSION['storeArray'] = array("name", "store_number","store_street_address", "city", "store_county", "store_state", "store_zip","sales_district", "sales_region");
	$_SESSION['promotion'] = array("promotion_name","price_reduction_type","ad_type", "display_type", "coupon_type", "ad_media","display_provider");

	function createList($name){
		foreach ($_SESSION['attributes'] as $attributes) {
        	echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'"/>';
    	}
	}

	function dimensionShift($type, $name)
	{
		if($type === "drillDown"){
			$neededAttributes = iterateArray();
			foreach ($neededAttributes as $attr) {
				echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'"/>';
				
			}
		}
		else if($type === "rollUp"){
			foreach ($_SESSION['attributes'] as $attributes) {
	        	echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'"/>';
	    	}
		}
	}

	function iterateArray(){
		$newArray = array();
		foreach ($_SESSION['allAttributes'] as $attr) {
			if(!in_array($attr, $_SESSION['attributes']))
				array_push($newArray,$attr);
		}
		return $newArray;
	}
?>
<html>
<head>
	<link rel = "stylesheet" type="text/css" href="style/style.css"/>
    <title>Home Page</title>
    
</head>

<body>
    <div class="container">
        <h1>Business Intelligence Tool</h1>
        <img src="ERDiagram.png" alt="Schema" />
        <br />
        <br />

        <!-- Displaying the Current Attributes of the Central Cube -->

        <h2> Current Attribute: <?php
        	$length = count($_SESSION['attributes']);
        	$i = 0;
        	
        	foreach ($_SESSION['attributes'] as $attributes) {
        		$array = $attributes."Array";
        		
        		if(++$i === $length)
        			echo ucfirst($_SESSION[$array][$_SESSION[$attributes]]) .". ";
        		else
        			echo ucfirst($_SESSION[$array][$_SESSION[$attributes]]) .", ";
        	}
        ?>
         </h2>

         <!-- Viewing the Central Cube -->
        <form method="post" action="centralCube.php">
            <p>Display Central Cube</p>
            <input type="submit" value="Central Cube" />
        </form>
        
        <!-- Drilling down based on the Hierarchy/Dimensions -->
        <form method="post" action="drillDown.php">
            <p>Climb down the concept hierarchy</p>

            <?php
            	createList("Hierarchy");
        	?>

            <p>Drill down on the central cube by adding a dimension</p>
            <?php
            	dimensionShift("drillDown", "Dimension");
        	?>       
    	</form>
        
        <!-- Rolling up Based on Hierarchy/Dimension -->
        <form method="post" action="rollUp.php">
            <p>Climb up the concept hierarchy</p>
           	<?php
            	createList("Hierarchy");
        	?>
            
            <p>Roll up the central cube by removing a dimension</p>
            
            <?php
            	dimensionShift("rollUp", "Dimension");
        	?>   
        </form>
        
        <form method="post" action="slice.php">
            <p>Slice</p>
            <input type="submit" value="Slice" />
        </form>
        <form method="post" action="dice.php">
            <p>Dice</p>
            <input type="submit" value="Dice" />
        </form>

        <br/>
        <br />
    </div>

</body>
</html>
