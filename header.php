<!DOCTYPE html>
<?php
	#Setting up the session
	include_once('session.php');
	
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
            <div class = 'inputs'>
                <p>Display Central Cube</p>
                <input type="submit" value="Central Cube" />
            </div>
        </form>
        <!-- Drilling down based on the Hierarchy/Dimensions -->
        <form method="post" action="drillDown.php">
            <p>Climb down the concept hierarchy</p>

            <?php
            	createList("drillDown", "Hierarchy");
        	?>

            <p>Drill down on the central cube by adding a dimension</p>
            <?php
            	createList("drillDown", "Dimension");
        	?>       
    	</form>
        
        <!-- Rolling up Based on Hierarchy/Dimension -->
        <form method="post" action="rollUp.php">
            <p>Climb up the concept hierarchy</p>
           	<?php
            	createList("rollUp", "Hierarchy");
        	?>
            
            <p>Roll up the central cube by removing a dimension</p>
            
            <?php
            	createList("rollUp", "Dimension");
        	?>   
        </form>
        
        <form method="post" action="slice.php">
            <div class = 'inputs'>
                <p>Slice</p>
                <input type="submit" value="Slice" />
            </div>
        </form>
        <form method="post" action="dice.php">
            <div class = 'inputs'>
                <p>Dice</p>
                <input type="submit" value="Dice" />
            </div>
        </form>
        <br/>
        <br />
    </div>

</body>
</html>
