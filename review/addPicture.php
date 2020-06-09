<?php
include('connection.php');
session_start();
$UID=$_POST['UID'];
  function GetImageExtension($imagetype)
   {
     if(empty($imagetype)) return false;
     switch($imagetype)
     {
         case 'image/bmp': return '.bmp';
         case 'image/gif': return '.gif';
         case 'image/jpeg': return '.jpg';
         case 'image/png': return '.png';
         default: return false;
     }
   }

if (!empty($_FILES["uploadedimage"]["name"])) {

$file_name=$_FILES["uploadedimage"]["name"];
$temp_name=$_FILES["uploadedimage"]["tmp_name"];
$imgtype=$_FILES["uploadedimage"]["type"];
$ext= GetImageExtension($imgtype);
$target_path = "img/".$_SESSION['user_name'].$ext;
$iName=$_SESSION['user_name'];

    if(move_uploaded_file($temp_name, $target_path)) {
      $sql="UPDATE imageUser SET imageName='" . $iName . "', imagePath='" . $target_path . "' WHERE UID=" . $UID;
      $conn->query($sql);
    }
}

$conn->close();
header('Location: ' .  $_SERVER['HTTP_REFERER']);
?>
