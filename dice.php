<!DOCTYPE html>

<?php include('dbconnect.php');?>
<html>
<head>
    <title>Olap</title>
</head>

<body>

        <button type = "submit" id = "originalCube" onclick = "javascript:window.location='./'"> Return to Original Cube </button>
        
    <table>
        <?php 
        include('header.php');
        ?>
        <tr>
            <th>store_county</th>
            <th>department</th>                             
            <th>day_of_week</th>
            <th>Dollar_Sales</th>
        </tr>
        <?php
        
            //Central Cube 
            $sql = "select store_county, department ,day_of_week, sum(dollar_sales) AS Dollar_Sales
                    From Store S, Product P, Time T, SalesFact F
                    Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key AND (T.day_of_week = 'Monday'
                        OR T.day_of_week = 'Tuesday') AND (store_county = 'King' OR store_county ='New York')
                    Group By store_county, department, day_of_week;" ;

            $result = $conn->query($sql);
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                
                echo "<td>" .$row["store_county"]. "</td>";
                
                echo "<td>" .$row["department"]. "</td>";
                
                echo "<td>" .$row["day_of_week"]. "</td>";
                
                echo "<td>" .$row["Dollar_Sales"]. "</td>";
                
                echo "</tr>";
            }
        ?>
            
        
    </table>
</body>
</html>
