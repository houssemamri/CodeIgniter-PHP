

<?php
	 $servername = "reviewthcpuser.mysql.db";
	$username = "reviewthcpuser";
	$password = "Ecsp28051985";
	$dbname = "reviewthcpuser"; 
	/*$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "iframe";*/

// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	
	$conn->set_charset("utf8");
	$conn->query("SET collation_connection = 'utf8'");

?>
