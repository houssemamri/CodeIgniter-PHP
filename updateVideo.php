<?php
include('connection.php');
$CID = $_POST['CID'];
$name = $_POST['title'];
$VID = $_POST['VID'];
$sql = "UPDATE video SET Name='" . $name . "', CID=" . $CID . " WHERE VID=" . $VID;
$conn->query($sql);
$conn->close();
?>