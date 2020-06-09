<?php
include('connection.php');
$UID = $_POST['uid'];
$mail = $_POST['mail'];
$first = $_POST['first'];
$last = $_POST['last'];
$company = $_POST['company'];
$mobile = $_POST['mobile'];

if ($mail !== '' || $first !== '' || $last !== '' || $company !== '' || $mobile !== '') {  
  $sql="INSERT INTO EmailList(UID,Email,First,Last,Company,Mobile) VALUES (" . $UID . ",'" . $mail . "','" . $first . "','" . $last . "','" . $company . "','" . $mobile . "')";
  $result = $conn->query($sql);
  if ($result) {
    echo "true";
  } else {
    echo "false";
  }  
} else {
  echo "false";
}

$conn->close();
?>
