<!DOCTYPE html>

<?php include('dbconnect.php');
    
    // include('session.php');
?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Olap</title>
</head>

<body>
    <!-- <button type = "submit" id = "originalCube" onclick = "javascript:window.location='./'"> Return to Original Cube </button> -->
      
    <table>

        <?php
        

           
            $sql = createSqlStatement(False, null);
            $result = $conn->query($sql);

            // include('header.php');
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
