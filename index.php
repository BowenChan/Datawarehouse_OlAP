<!DOCTYPE html>

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
        <h2>Concept Hierarchy: city -> store_county -> store_state </h2>
        <form method="post" action="centralCube.php">
            <p>Display Central Cube</p>
            <input type="submit" value="Central Cube" />
        </form>
        
        <form method="post" action="drillDown.php">
            <p>Climb down the concept hierarchy</p>
            <input type="submit" value="DrillDown" name="HierarchyD"/>
            
            <p>Drill down on the central cube by adding a dimension</p>
            <input type="submit" value="DrillDown" name="DimensionD"/>
        </form>
        
        <form method="post" action="rollUp.php">
            <p>Climb up the concept hierarchy</p>
            <input type="submit" value="RollUp" name = "HierarchyR"/>
            
            <p>Roll up the central cube by removing a dimension</p>
            <input type="submit" value="RollUp" name = "DimensionR"/>
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
