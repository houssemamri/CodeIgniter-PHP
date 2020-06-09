<?php
include('connection.php');
$LID=$_POST['lid'];
$sql="DELETE FROM EmailListSub WHERE LID=" . $LID;
$conn->query($sql);
$sql="DELETE FROM EmailListMain WHERE LID=" . $LID;
$conn->query($sql);
$conn->close();
?>
