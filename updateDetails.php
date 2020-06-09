<?php
include('connection.php');
$UID=$_POST['uid'];
$name=$_POST['name'];
$company=$_POST['company'];
$position=$_POST['position'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$sql="UPDATE UserTable SET Name='" . $name . "', Company='" . $company . "', Position='" . $position . "', Email='" . $email . "', Contact='" . $contact . "'  WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
?>
