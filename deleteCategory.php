<?php
include('connection.php');
$CID = $_POST['CID'];
$sql = "DELETE FROM videoCategory WHERE CID = " . $CID;
$conn->query($sql);
$conn->close();
?>