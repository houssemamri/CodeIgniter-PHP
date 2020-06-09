<?php
include('connection.php');
$EID = $_POST['eid'];
$mail = $_POST['mail'];
$first = $_POST['first'];
$last = $_POST['last'];
$company = $_POST['company'];
$mobile = $_POST['mobile'];
$service = $_POST['service'];
$comment = $_POST['comment'];

$sql="UPDATE EmailList SET Email='" . $mail . "', First='" . $first . "', Last='" . $last . "', Company='" . $company . "', Mobile='" . $mobile . "' , service='".$service."', comment='".$comment."' WHERE EID = " . $EID;

$conn->query($sql);
$conn->close();
?>
