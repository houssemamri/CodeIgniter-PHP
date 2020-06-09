
<?php
session_start();
include('connection.php');
$sql="SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$name=$row['Name'];
$company=$_POST['company'];
$number=rand();
$email=$row['Email'] . " - Master" . $number;
$position=$row['Position'];
$contact=$row['Contact'];
$sql="INSERT INTO UserTable(Name,Company,Position,Email,Contact) VALUES('" . $name . "','" . $company . "','" . $position . "','" . $email . "','" . $contact . "')";
$conn->query($sql);
$sql="SELECT * FROM UserTable ORDER BY UID desc LIMIT 1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$sql="INSERT INTO Master(MasterID,SubID) VALUES(" . $_SESSION['user_id'] . "," . $row['UID'] . ")";
$conn->query($sql);
$sql="INSERT INTO imageUser(imageName,imagePath) VALUES('Default','img/default_profile.png')";
$conn->query($sql);
$conn->close();
?>
