<?php
include('connection.php');
$UID=$_POST['uid'];
$Item=$_POST['item'];
$sql="INSERT INTO todolist(UID,Item) VALUES(" . $UID . ",'" . $Item . "')";
$conn->query($sql);
$conn->close();
?>
