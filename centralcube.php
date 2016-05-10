<!DOCTYPE html>

<?php include('dbconnect.php');
?>
<html>
<head>
    <title>Olap</title>
</head>

<body>
    <table>
        <tr>
            <th>store_county</th>
            <th>department</th>                             
            <th>day_of_week</th>
            <th>Dollar_Sales</th>
        </tr>
        <?php
        
            //Central Cube 
            $sql = "select ".$_SESSION['store']. ", ". $_SESSION['product'] ." ," .$_SESSION['time'] .", sum(dollar_sales) AS Dollar_Sales
                    From Store S, Product P, Time T, SalesFact F
                    Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                    Group By ".$_SESSION['store']. ", ". $_SESSION['product'] ." ," .$_SESSION['time'] .";" ;

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
