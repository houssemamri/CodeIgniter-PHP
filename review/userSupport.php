<?php
include('connection.php');

$email=$_POST['email'];
$name=$_POST['sname'];
$message=$_POST['message'];
$sql="INSERT INTO Support(Email,Name,Message,Status) VALUES ('" . $email . "','" . $name . "','" . $message . "',0)";
$conn->query($sql);
$conn->close();
$email_address="soumyanil666@gmail.com";
// Create the email and send the message
$to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Support Avis Client From : $name";
$email_body = "The message is as: \n\n\n $message" ;
$headers = "From: $email \n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email ";
$headers .= "Return-Path: $email\r\n";
if(mail($to,$email_subject,$email_body,$headers)){
  header('Location:' . 'support.php?success=true');
}
else{
  header('Location:' . 'support.php?success=false');
}
 ?>
