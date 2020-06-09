<?php
include('connection.php');
$TID=$_POST['tid'];
$Item=$_POST['item'];
$Date=$_POST['Date'];
$comment=$_POST['Comment'];
$sql="UPDATE todolist SET Item='" . $Item . "',due_date='".$Date."',comment='".$comment."'  WHERE TID=" . $TID;
$conn->query($sql);
$conn->close();
?>
