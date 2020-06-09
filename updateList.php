<?php
include('connection.php');
session_start();
$lid=$_POST['lid'];
$emails=$_POST['emails'];
foreach($emails as $EID)
{
  $sql="SELECT * FROM EmailListSub WHERE LID=" . $lid . " AND EID=" . $EID;
  $result=$conn->query($sql);
  if($result->num_rows==0)
  {
    $sql="INSERT INTO EmailListSub(LID,EID) VALUES(" . $lid . "," . $EID . ")";
    $conn->query($sql);
  }
}
$conn->close();
?>
