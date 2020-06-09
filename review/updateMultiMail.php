<?php
include('connection.php');
$EID=$_POST['eid'];
$mail=$_POST['mail'];
$first=$_POST['first'];
$last=$_POST['last'];
$company=$_POST['company'];

$sql="UPDATE EmailList SET Email='" . $mail . "', First='" . $first . "', Last='" . $last . "', Company='" . $company . "' WHERE EID=" . $EID;
$conn->query($sql);
$conn->close();
?>
