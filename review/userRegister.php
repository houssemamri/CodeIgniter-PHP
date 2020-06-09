<?php
include('connection.php');
$name=$_POST['username'];
$company=$_POST['company'];
$position=$_POST['position'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$pwd=$_POST['password'];
$password=password_hash($pwd, PASSWORD_DEFAULT);
$sql="INSERT INTO UserTable(Name,Company,Position,Email,Contact,Password) VALUES('" . $name . "','" . $company . "','" . $position . "','" . $email . "','" . $contact . "','" . $password . "')";
//echo $sql;
$conn->query($sql);
$sql="SELECT * FROM UserTable ORDER BY UID desc LIMIT 1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$sql="INSERT INTO Master(MasterID,SubID) VALUES(" . $row['UID'] . "," . $row['UID'] . ")";
$conn->query($sql);
$sql="INSERT INTO imageUser(imageName,imagePath) VALUES(' ',' ')";
$conn->query($sql);
$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
