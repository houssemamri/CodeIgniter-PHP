<?php
ob_start();
session_start();
//Database Connection
include('configdata.php');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".$dbServer.";dbname=".$dbName, $dbUsername, $dbPassword);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);


//timezone
date_default_timezone_set("Africa/nairobi");

//error reporting
error_reporting(0);



?>

