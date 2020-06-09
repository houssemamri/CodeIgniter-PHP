<?php
include('connection.php');
require_once 'PHPExcel/IOFactory.php';
require_once('phpmailer/PHPMailerAutoload.php');
session_start();
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
$target_path="";
if (!empty($_FILES["uploadedimage"]["name"]))
{
  $file_name=$_FILES["uploadedimage"]["name"];
  $temp_name=$_FILES["uploadedimage"]["tmp_name"];
  $imgtype=$_FILES["uploadedimage"]["type"];
  $ext= GetImageExtension($imgtype);
  $target_path = "img/" . $_SESSION['user_name'] . " - " . $file_name . $ext;
}


$EID=$_POST['listEmail'];
$emailFrom=$_POST['Email'];
$subject=$_POST['subject'];
$message=$_POST['message'];

$message .= "\n\n <img src='http://review-thunder.com/" . $target_path . "' />";

$flag=0;
$sql="SELECT Name,SMTP,SMTPuser,SMTPpwd FROM UserTable WHERE UID=" . $_SESSION['user_id'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$email = new PHPMailer();
$email->isSMTP();
$email->SMTPAuth = true;
$email->Host = $row['SMTP'];
$email->Port = 587;
$email->Username = $row['SMTPuser'];
$email->Password = $row['SMTPpwd'];
$email->From      = $emailFrom;
$email->FromName  = $row['Name'];
$email->Subject   = $subject;
$email->Body      = $message;
$sql="SELECT * FROM EmailListing WHERE LID=" . $LID;
$result=$conn->query($sql);
while($row=$result->fetch_assoc())
{
  if(filter_var($row['Email'], FILTER_VALIDATE_EMAIL))
  {
    $email->AddAddress($row['Email']);
    if($email->send()) {
      $flag=1;
    } else {
      $flag=0;
    }
  }
}
$conn->close();
header('Location:' . $_SERVER['HTTP_REFERER']);
?>
