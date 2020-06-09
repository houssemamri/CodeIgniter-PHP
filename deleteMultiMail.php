<?php
include('connection.php');
$EID=$_POST['eid'];
$sql="DELETE FROM EmailList WHERE EID=" . $EID;
$conn->query($sql);
$sql="DELETE FROM EmailListSub WHERE EID=" . $EID;
$conn->query($sql);
$conn->close();
?>
