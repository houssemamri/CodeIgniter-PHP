<?php
include('connection.php');
$UID=$_POST['uid'];
$mail=$_POST['mail'];
$first=$_POST['first'];
$last=$_POST['last'];
$company=$_POST['company'];

if(filter_var($mail, FILTER_VALIDATE_EMAIL))
  {
    $sql="INSERT INTO EmailList(UID,Email,First,Last,Company) VALUES (" . $UID . ",'" . $mail . "','" . $first . "','" . $last . "','" . $company . "')";
    $conn->query($sql);
  }
$conn->close();
?>
