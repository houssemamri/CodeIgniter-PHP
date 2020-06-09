<?php
header('Content-Type: text/html; charset=utf-8');
include('connection.php');
session_start();
$type=$_POST['type'];
$lang=$_POST['lang'];
$num=$_POST['article'];
$UID=$_SESSION['user_id'];
$text=$_POST['text'];
if(strcmp($lang,"fr")==0)
{
  $article=$num;
}
else if(strcmp($lang,"en")==0)
{
  $article=$num+3;
}
else
{
  $article=$num+5;
}
$sql="SELECT * FROM UserSave WHERE UID=" . $UID . " AND category='" . $type . "' AND Article=" . $article;
$result=$conn->query($sql);
if($result->num_rows==0)
{
  $sql="INSERT INTO UserSave(UID,Text,Article,Category) VALUES(" . $UID . ",'" . $conn->real_escape_string($text) . "'," . $article . ",'" . $type . "')";
  $conn->query($sql);
}
else
{
    $sql="UPDATE UserSave SET Text='" . $conn->real_escape_string($text) . "' WHERE UID=" . $UID . " AND Article=" . $article . " AND Category='" . $type . "'";
    $conn->query($sql);
}
$conn->close();
?>
