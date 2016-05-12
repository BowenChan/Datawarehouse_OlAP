<!DOCTYPE html>
<?php
	#Setting up the session
    include('dbconnect.php');
	include_once('session.php');
	
?>
<html>
<head>

	<link rel = "stylesheet" type="text/css" href="style/style.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <title>Home Page</title>
    <script type="text/javascript">
        $(document).ready(function() {
    
            $(".centralCube").on("click", function( e ) {
        
            e.preventDefault();
        
            $("body, html").animate({ 
                scrollTop: $( $(this).attr('href') ).offset().top 
            }, 600);
        
            });
        
        });
    </script>
</head>

<body>
    <div class="container">
        <h1>Business Intelligence Tool</h1>
        <h2> By: Bowen Chan, Naghmeh Anvari, Battista Egcasenza </h2>
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
        <form method="post"> <!-- action="centralCube.php"> -->
            <div class = 'inputs'>
                <p>Display Central Cube</p>
                <input type="submit" value="Central Cube" class = "centralCube" href = "#centralCube" />
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
            <p>Slice</p>
                <div class = 'inputs'>         
                <?php 
                        echo "Inside";
                        foreach ($_SESSION['attributes'] as $attrSlice) {
                            $sqlSlice = grabAllPossibleAttribute($attrSlice);
                            $resultSlice = $conn->query($sqlSlice);
                            while($rowSlice = $resultSlice->fetch_assoc())
                            {
                                buttonCreate($attrSlice, $rowSlice[$_SESSION[$attrSlice."Array"][$_SESSION[$attrSlice]]]);
                                //echo "<br>";
                            }
                        }
                ?>
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
    
    <div id ="centralCube"> Current Central Cube</div>
</body>
    
</html>
