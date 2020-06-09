<?php
include('connection.php');
$UID=$_POST['uid'];
$Item=$_POST['item'];
$due_date=$_POST['date'];
$comment=$_POST['comment'];
$sql="INSERT INTO todolist(UID,Item,due_date,comment) VALUES('".$UID."','" . $Item . "','".$due_date."','".$comment."')";
$conn->query($sql);
$conn->close();
?>
