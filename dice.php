<!DOCTYPE html>

<?php include('dbconnect.php');
    include('session.php');
?>
<html>
<head>
    <link rel = "stylesheet" type="text/css" href="style/style.css"/>

    <title>Olap</title>
</head>

<body>

        <button type = "submit" id = "originalCube" onclick = "javascript:window.location='./'"> Return to Original Cube </button>
        
    <table>

    <?php
        resetSlice();
        if(empty($_POST['store'])){
            $_POST['store'] = null;
        }

        if(empty($_POST['time'])){
            $_POST['time'] = null;
        }

        if(empty($_POST['product'])){
            $_POST['product'] = null;
        }

        if(empty($_POST['promotion'])){
            $_POST['promotion'] = null;
        }
            
          


        $sql = createSqlDiceStatement($_POST['store'],$_POST['time'],$_POST['product'],$_POST['promotion']);
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
