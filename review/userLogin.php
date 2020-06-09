<?php
include('connection.php');
$email=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * FROM users WHERE username like '" . $email . "'";
$result=$conn->query($sql);
if($result->num_rows==0)
{
  header('Location: ' . 'login.php?status=fail');
}
else
{
  $row=$result->fetch_assoc();
  
      session_start();
      $_SESSION['global_status']=true;
      $username=explode(" ",$row['username']);
      $_SESSION['user_name']=$row['username'];
      $_SESSION['master_id']=$row['user_id'];
      $_SESSION['user_id']=$row['user_id'];
      $_SESSION['language']='fr';
      if($row['role']==1)
      {
        $_SESSION['admin_status']=$row['role'];
        echo '1';
		die;
		
		//header('Location: ' . './');
      }
      else
      {
        $_SESSION['user_status']=1;
		 echo '0';
		die;
       // header('Location: ' . './');
      }
  
}
$conn->close();
 ?>
