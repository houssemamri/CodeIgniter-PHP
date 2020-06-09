<?php
include('connection.php');
$UID=$_POST['id'];
$sql="UPDATE UserTable SET DeleteStatus=1 WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
?>
