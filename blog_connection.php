<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "reviewthcpblog";

// Create connection
	$blog_conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($blog_conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	
	$blog_conn->set_charset("utf8");
	$blog_conn->query("SET collation_connection = 'utf8'");

?>




