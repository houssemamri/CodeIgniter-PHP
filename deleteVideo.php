<?php
include('connection.php');
$VID = $_POST['VID'];
$sql = "DELETE FROM video WHERE VID=" . $VID;
$conn->query($sql);
$conn->close();
?>