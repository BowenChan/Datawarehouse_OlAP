<!DOCTYPE html>

<?php include('dbconnect.php');
    include('session.php');
?>
<html>
<head>
    <title>Olap</title>
</head>

<body>

    <button type = "submit" id = "originalCube" onclick = "javascript:window.location='./'"> Return to Original Cube </button>
      
    <table>

        <?php
            resetSlice();
            if(isset($_POST['Hierarchy'])){
                decreaseHierarchy(lcfirst($_POST['Hierarchy']));
            }
            elseif(isset($_POST['Dimension'])){
                array_push($_SESSION['attributes'], lcfirst($_POST['Dimension']));
            }

            $sql = createSqlStatement(False, null);
            $result = $conn->query($sql);

            include('header.php');


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
