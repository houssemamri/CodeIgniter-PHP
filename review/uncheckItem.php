<?php
include('connection.php');
$TID=$_POST['tid'];
$sql="UPDATE todolist SET Done=0 WHERE TID=" . $TID;
$conn->query($sql);
$conn->close();
?>
