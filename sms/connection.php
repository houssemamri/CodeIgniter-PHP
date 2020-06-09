<?php

	$servername = "reviewthcpadmin.mysql.db";
	$username = "reviewthcpadmin";
	$password = "Thunder1";
	$dbname = "reviewthcpadmin";

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->set_charset("utf8");
	$conn->query("SET collation_connection = 'utf8'");

?>
