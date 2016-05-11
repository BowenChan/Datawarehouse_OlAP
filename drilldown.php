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

            $sql = "select ". iterateAttributes(False) ." sum(dollar_sales) AS Dollar_Sales
                        From Store S, Product P, Time T, SalesFact F
                        Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                        Group By ". iterateAttributes(True);

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
