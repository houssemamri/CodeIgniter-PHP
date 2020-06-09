<?php
include('connection.php');
$UID=$_POST['uid'];
$pwd=$_POST['pwd'];
$password=password_hash($pwd,PASSWORD_DEFAULT);
$sql="UPDATE UserTable SET Password='" . $password . "' WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
?>
