<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "datawarehouse";
	$dbc = mysqli_connect($severname,$username,$password,$db);
	$conn = new mysqli($servername,$username,$password,$db);
	if($conn ->connect_error) {
		die)"Connection Failed: " . $conn->connect_error);
	}
?>
