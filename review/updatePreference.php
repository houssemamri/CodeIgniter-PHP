<?php
include('connection.php');
session_start();
$sql="SELECT * FROM UserPrefer WHERE UID=" . $_SESSION['user_id'];
$result=$conn->query($sql);
if($result->num_rows==0)
{
  $sql="INSERT INTO UserPrefer(UID,S1,S2,S3,S4,S5,S6,S7,S8,S9,S10,S11,S12) VALUES(" . $_SESSION['user_id'] . ",'','','','','','','','','','','','')";
  $conn->query($sql);
}

$opt=$_POST['opt'];
$s1=$_POST['s1'];
$s2=$_POST['s2'];
$s3=$_POST['s3'];
$s4=$_POST['s4'];
if($opt==1)
  $sql="UPDATE UserPrefer SET S1='" . $s1 . "',S2='" . $s2 . "',S3='" . $s3 . "',S4='" . $s4 . "' WHERE UID=" . $_SESSION['user_id'];
else if($opt==2)
  $sql="UPDATE UserPrefer SET S5='" . $s1 . "',S6='" . $s2 . "',S7='" . $s3 . "',S8='" . $s4 . "' WHERE UID=" . $_SESSION['user_id'];
else
  $sql="UPDATE UserPrefer SET S9='" . $s1 . "',S10='" . $s2 . "',S11='" . $s3 . "',S12='" . $s4 . "' WHERE UID=" . $_SESSION['user_id'];
$conn->query($sql);
$conn->close();
?>
