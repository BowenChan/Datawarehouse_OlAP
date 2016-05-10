<!DOCTYPE html>

<html>
<head>
    <title>Home Page</title>
    <style>
        
        .container{
            width: 900px;
            background-color: #0D0D0D;
            margin-left: auto;
            margin-right: auto;
        }
        body{
            background-color: #444444;
        }
        h1,h2{
            text-align: center;
            padding: 20px;
            color: #DDDDDD;
            text-shadow: 2px 2px black;
        }
        img{
            border: solid 1px #ccc;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
            height: 500px;
            box-shadow: 10px 10px 5px #888888;
        }
        p{
            color: #DDDDDD;
            padding-left: 30px;
            
        }

        input {
            background-color: #AA2712;
            color: white;
            padding: 16px;
            font-size: 16px;
            margin-left: 30px; 
            border: none;
            cursor: pointer;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }


        input:hover{
            background-color: #299195;
        }

        
    </style>
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
