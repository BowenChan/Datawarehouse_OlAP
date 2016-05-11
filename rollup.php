<!DOCTYPE html>

<?php include('dbconnect.php');?>
<html>
<head>
    <title>Olap</title>
</head>

<body>
    <button type = "submit" id = "centralCube" onclick = "javascript:window.location='./'"> Central Cube </button>
    <table>
        
        <?php
       
            if(isset($_POST['HierarchyR'])){
        
    
                $sql = "select store_state, department ,day_of_week, sum(dollar_sales) AS Dollar_Sales
                        From Store S, Product P, Time T, SalesFact F
                        Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                        Group By store_state, department, day_of_week;" ;

                $result = $conn->query($sql);
                echo    "<tr>
                            <th>store_state</th>
                            <th>department</th>                             
                            <th>day_of_week</th>
                            <th>Dollar_Sales</th>
                        </tr>";
                 
                while($row = $result->fetch_assoc()) {
                       echo "<tr>";
                    
                    echo "<td>" .$row["store_state"]. "</td>";
                    
                    echo "<td>" .$row["department"]. "</td>";
                    
                    echo "<td>" .$row["day_of_week"]. "</td>";
                    
                    echo "<td>" .$row["Dollar_Sales"]. "</td>";
                    
                    echo "</tr>";
                }
            }
            elseif ($_POST['rollUpB'] == 'DimensionR')
            {
                $sql = "select store_county, department, sum(dollar_sales) AS Dollar_Sales
                        From Store S, Product P, Time T, SalesFact F
                        Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                        Group By store_county, department;" ;

                $result = $conn->query($sql);
                echo    "<tr>
                            <th>store_state</th>
                            <th>department</th>                             
                            <th>Dollar_Sales</th>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    
                    echo "<td>" .$row["store_county"]. "</td>";
                    
                    echo "<td>" .$row["department"]. "</td>";
                    
                   
                    
                    echo "<td>" .$row["Dollar_Sales"]. "</td>";
                    
                    echo "</tr>";
                } 
            }
            
        ?>
            
        
    </table>
</body>
</html>
