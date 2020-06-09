
<?php
include('connection.php');
session_start();
$lname=$_POST['lid'];
$emails=$_POST['emails'];
$sql="INSERT INTO EmailListMain(UID,ListName) VALUES (" . $_SESSION['user_id'] . ",'" . $lname . "')";
$conn->query($sql);
$sql="SELECT LID FROM EmailListMain Order By LID desc limit 1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$LID=$row['LID'];
foreach($emails as $EID)
{
  $sql="INSERT INTO EmailListSub(LID,EID) VALUES(" . $LID . "," . $EID . ")";
  $conn->query($sql);
}
//print_r($_POST['emails']);
$conn->close();
?>
