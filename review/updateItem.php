<?php
include('connection.php');
$TID=$_POST['tid'];
$Item=$_POST['item'];
$sql="UPDATE todolist SET Item='" . $Item . "' WHERE TID=" . $TID;
$conn->query($sql);
$conn->close();
?>
