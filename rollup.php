<!DOCTYPE html>


<?php 
    include('session.php');
    
?>
<html>
<head>
<link rel = "stylesheet" type="text/css" href="style/style.css"/>

    <title>Olap</title>
</head>

<body>
    <button type = "submit" id = "centralCube" onclick = "javascript:window.location='./'"> Central Cube </button>
    <table>
        
        <?php
            
            #Going +1 OF THE ARRAY
            if(isset($_POST['Hierarchy'])){
                increaseHierarchy(lcfirst($_POST['Hierarchy']));
            }

            # Removing a column
            elseif (isset($_POST['Dimension']))
            {
                unset($_SESSION['attributes'][array_search(lcfirst($_POST['Dimension']), $_SESSION['attributes'])]);   
            }

            $sql = createSqlStatement();
            $result = $conn->query($sql);

            include('header.php');
            echo "<tr>";
            displayTableAttributes("tr", null);
            echo "</tr>";       
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                               
                displayTableAttributes("td", $row);

         
                echo "</tr>";
            }
            
        ?>
            
        
    </table>

 
</body>
</html>
