<?php
include('connection.php');
$CID = $_POST['CID'];
$category = $_POST['category'];
$sql = "UPDATE videoCategory SET Category ='" . $category . "' WHERE CID = " . $CID;
$conn->query($sql);
$conn->close();
?>