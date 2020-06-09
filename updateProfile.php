<?php
include('connection.php');
$UID=$_POST['uid'];
$SMTP=$_POST['smtp'];
$SUSER=$_POST['user'];
$SPWD=$_POST['pwd'];
$sql="UPDATE UserTable SET SMTP='" . $SMTP . "', SMTPuser='" . $SUSER . "', SMTPpwd='" . $SPWD . "'  WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
?>
