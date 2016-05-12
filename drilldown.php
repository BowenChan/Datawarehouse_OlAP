<!DOCTYPE html>

<?php include('dbconnect.php');
    include('session.php');
?>
<html>
<head>
    <title>Olap</title>
</head>

<body>
    <button type = "submit" id = "centralCube" onclick = "javascript:window.location='./'"> Central Cube </button>
    
    <table>

        <?php
       
            if(isset($_POST['Hierarchy'])){
                decreaseHierarchy(lcfirst($_POST['Hierarchy']));
            }
            elseif(isset($_POST['Dimension'])){
                array_push($_SESSION['attributes'], lcfirst($_POST['Dimension']));
            }

            $sql = createSqlStatement(False, null);
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
