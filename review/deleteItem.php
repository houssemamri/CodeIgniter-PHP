<?php
include('connection.php');
$TID=$_POST['tid'];
$sql="DELETE FROM todolist WHERE TID=" . $TID;
$conn->query($sql);
$conn->close();
?>
