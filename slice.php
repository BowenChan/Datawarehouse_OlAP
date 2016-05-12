<!DOCTYPE html>

<?php 
    include('dbconnect.php');
    include('session.php');
?>
<html>
<head>
    <title>Olap</title>
    <link rel = "stylesheet" type="text/css" href="style/style.css"/>

</head>
<body>

    <button type = "submit" id = "originalCube" onclick = "javascript:window.location='./'"> Return to Original Cube </button>
    
    <table>
        
        <?php
            
            $sliceImplode = explode(" | ", $_POST['slice']);
            
            $sliceImplode[0] = lcfirst($sliceImplode[0]);
            
            resetSlice();

            array_unshift($_SESSION['currentSlice'], $sliceImplode);
            
          
            
            $sql = createSqlStatement(True, $sliceImplode[1]);
            $result = $conn->query($sql);
            include('header.php');
            echo $sql;
            
            echo "<tr>";
            displayTableAttributes("tr", null);

            echo "</tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                
                displayTableAttributes("td", $row);

         
                echo "</tr>";
            }

            // //Central Cube 
            // $sql = "select store_county, department ,day_of_week, sum(dollar_sales) AS Dollar_Sales
            //         From Store S, Product P, Time T, SalesFact F
            //         Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key AND T.day_of_week = 'Monday'
            //         Group By store_county, department, day_of_week;" ;

            // $result = $conn->query($sql);
            
            // while($row = $result->fetch_assoc()) {
            //     echo "<tr>";
                
            //     echo "<td>" .$row["store_county"]. "</td>";
                
            //     echo "<td>" .$row["department"]. "</td>";
                
            //     echo "<td>" .$row["day_of_week"]. "</td>";
                
            //     echo "<td>" .$row["Dollar_Sales"]. "</td>";
                
            //     echo "</tr>";
            // }
        ?>
            
        
    </table>
</body>
</html>
