<?php
include('connection.php');
include('setLanguage.php');
$email_address = $_POST['email'];
$sql="SELECT * FROM UserTable WHERE Email like '" . $email_address . "'";
$result=$conn->query($sql);
if($result->num_rows==0)
{
  echo "<div class='alert alert-warning'>" . $invalidEmail . "</div>";
}
else
{
  $admin_email=" edouard@review-thunder.com";
  // Create the email and send the message
  $to = $email_address; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
  $email_subject = "Forgot Password";
  $email_body = $passwordEmail . " : https://demo.soumyanildas.com/NewDesign/forgotPassword.php?email=$email_address " ;
  $headers = "From: $admin_email\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
  $headers .= "Reply-To: $admin_email";
  $headers .= "Return-Path: $admin_email\r\n";
  if(mail($to,$email_subject,$email_body,$headers)){
    echo "<div class='alert alert-success'>" . $checkEmailForgot . "</div>";
  }
  else
  {
    echo "<div class='alert alert-danger'>" . $wrongEmail . "</div>";
  }
}
$conn->close();
?>
