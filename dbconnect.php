<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "datawarehouse";
	$dbc = mysqli_connect($servername,$username,$password,$db);
	$conn = new mysqli($servername,$username,$password,$db);
	if($conn ->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	}
?>
