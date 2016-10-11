<?php
	//DATABASE CONNECTION - OPEN
	//DB connection variables
	$servername = "localhost";
	$username 	= "root";
	$password	= "";
	$dbname		= "dvd_shop";

	//DB connection
	$conn = new mysqli($servername, $username, $password, $dbname); 

	//Check connection
	if($conn->connect_error){
		die ("Connection Failed:" . $conn->connect_error . "<br>");
		}
	// echo "Connected Successfully <br>";
?>