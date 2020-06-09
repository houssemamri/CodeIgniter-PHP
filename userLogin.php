<?php

include('connection.php');
$email=$_POST['email'];
$password=$_POST['password'];
$sql="SELECT * FROM UserTable WHERE Email like '" . $email . "'";
$result=$conn->query($sql);


if($result->num_rows==0)
{
  header('Location: ' . 'login.php?status=fail');
}
else
{
  $row=$result->fetch_assoc();
  if(password_verify($password, $row['Password']))
  {
      session_start();
      $_SESSION['global_status']=true;
      $username=explode(" ",$row['Name']);
      $_SESSION['user_name']=$username[0];
      $_SESSION['master_id']=$row['UID'];
      $_SESSION['user_id']=$row['UID'];
      $_SESSION['language']=$_POST['setLang'];
      if($row['adminstatus']==1)
      {
        $_SESSION['admin_status']=$row['adminstatus'];
		if($row['role']==1){
		echo "1";
		die;
			
		}else{
		echo "0";
		die;
			
		}
		
        //header('Location: ' . './');
      }
      else
      {
        $_SESSION['user_status']=1;
		if($row['role']==1){
		echo "1";
		die;
			
		}else{
		echo "0";
		die;
			
		}
        //header('Location: ' . './');
      }
  }
  else
  {
      header('Location: ' . 'login.php?status=fail');
  }
}
$conn->close();
 ?>
