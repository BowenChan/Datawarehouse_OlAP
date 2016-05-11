<!DOCTYPE html>

<html>
<head>
	<link rel = "stylesheet" type="text/css" href="style/style.css"/>
    <title>Home Page</title>
    
</head>

<body>
    <?php
        include('session.php');
        setSessions();
        include('header.php');
        include('dbconnect.php');
        include('selectdb.php');
    ?>
</body>
</html>
