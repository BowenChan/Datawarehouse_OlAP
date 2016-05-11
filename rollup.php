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
                 
             
            #Going +1 OF THE ARRAY
            if(isset($_POST['Hierarchy'])){
                increaseHierarchy(lcfirst($_POST['Hierarchy']));
                //$_SESSION[lcfirst($_POST['Hierarchy'])] = $_SESSION[lcfirst($_POST['Hierarchy'])] + 1;
                echo  lcfirst($_POST['Hierarchy']);
            }

            # Removing a column
            elseif (isset($_POST['Dimension']))
            {
                unset($_SESSION['attributes'][array_search(lcfirst($_POST['Dimension']), $_SESSION['attributes'])]);   
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
