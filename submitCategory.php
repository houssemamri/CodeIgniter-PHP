<?php
include('connection.php');
$category = $_POST['category'];
$UID = $_POST['UID'];
$sql = "INSERT INTO videoCategory VALUES (default, " . $UID . ",'" . $category . "')";
$conn->query($sql);
$conn->close();
?>