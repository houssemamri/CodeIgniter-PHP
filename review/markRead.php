<?php
include('connection.php');
$SID=$_POST['id'];
$sql="UPDATE Support SET Status=1 WHERE SID=" . $SID;
$conn->query($sql);
$conn->close();
 ?>
