<!DOCTYPE html>

<html>
<head>
	<link rel = "stylesheet" type="text/css" href="style/style.css"/>
    <title>Home Page</title>
    
</head>

<body>
	<table>
    <?php
        include('session.php');
        setSessions();
        include('header.php');
        include('dbconnect.php');
        include('selectdb.php');
    	include('centralcube.php');
    ?>
    </table>
</body>
</html>
