<?php

	$servername = "reviewthcplethe.mysql.db";
	$username = "reviewthcplethe";
	$password = "RTLethe1071";
	$dbname = "reviewthcplethe";

// Create connection
	$connews = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($connews->connect_error) {
    	die("Connection failed: " . $connews->connect_error);
	}
	
	$connews->set_charset("utf8");
	$connews->query("SET collation_connection = 'utf8'");

?>
