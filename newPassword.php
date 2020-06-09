<?php
include('connection.php');
$email=$_POST['email'];
$pwd=$_POST['pwd'];
if($pwd=="")
{
  echo "<div class='alert alert-danger'>" . $enterProper . "</div>";
}
else
{
    $password=password_hash($pwd,PASSWORD_DEFAULT);
    $sql="UPDATE UserTable SET Password='" . $password . "' WHERE Email like'" . $email . "'";
    if($conn->query($sql)){
      echo "<div class='alert alert-success'>" . $passwordChangeSuccess . "</div>";
    }
    else
    {
      echo "<div class='alert alert-danger'>" . $passwordTryAgain . "</div>";
    }

}
$conn->close();
?>
