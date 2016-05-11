<!DOCTYPE html>

<?php include('dbconnect.php');
   session_start();
    function iterateAttributes($select){
        $length = count($_SESSION['attributes']);
        $i = 0;
        $string = "";
        foreach ($_SESSION['attributes'] as $attributes) {
            $array = $attributes."Array";
                
            if(++$i === $length && $select)
                $string  .= lcfirst($_SESSION[$array][$_SESSION[$attributes]]) .";";
            else
                $string .= lcfirst($_SESSION[$array][$_SESSION[$attributes]]) .", ";
        }
        return $string;
    }

    function displayTableAttributes($type, $data){

        foreach ($_SESSION['attributes'] as $attributes) {
            $array = $attributes."Array";
            if($type === "tr"){
                
                echo '<th>'. ucfirst($_SESSION[$array][$_SESSION[$attributes]]) .'</th>';
            }
            elseif ($type === "td"){
                echo '<td>' . $data[$_SESSION[$array][$_SESSION[$attributes]]] . '</td>';
                
            }
        }
        if($type === "tr")
            echo '<th> Dollar_Sales </th>';
        else if($type === "td")
            echo '<td>' . $data["Dollar_Sales"] . '</td>';
    } 
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
                 
              $_SESSION[lcfirst($_POST['Hierarchy'])] -= 1;
    
                $sql = "select ". iterateAttributes(False) ." sum(dollar_sales) AS Dollar_Sales
                        From Store S, Product P, Time T, SalesFact F
                        Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                        Group By ". iterateAttributes(True);

                $result = $conn->query($sql);

                echo "<tr>";
                displayTableAttributes("tr", null);
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    
                    displayTableAttributes("td", $row);

             
                    echo "</tr>";
                }
            }
            elseif(isset($_POST['Dimension'])){
                array_push($_SESSION['attributes'], lcfirst($_POST['Dimension']));
                $sql = "select ". iterateAttributes(False) ." sum(dollar_sales) AS Dollar_Sales
                        From Store S, Product P, Time T, Promotion PR,  SalesFact F
                        Where  S.store_key = F.store_key AND P.product_key = F.product_key AND T.time_key = F.time_key
                        Group By ". iterateAttributes(True);

                $result = $conn->query($sql);

                echo "<tr>";
                displayTableAttributes("tr", null);
                echo "</tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    
                    displayTableAttributes("td", $row);

             
                    echo "</tr>";
                }        
            }
        ?>
            
        
    </table>
</body>
</html>
