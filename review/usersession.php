<?php
header('Content-Type: Application/JSON');
header('Access-Control-Allow-Origin: *');
session_start();
if(isset($_SESSION['global_status'])){
  $status = true;
}
else{
  $status = false;
}
if(isset($_SESSION['admin_status'])){
  $output = array(
    "GlobalStatus" => $status,
    "UID" => $_SESSION['user_id'],
    "AdminStatus" => 1,
    "UserName" => $_SESSION['user_name']
  );
}
else{
  $output = array(
    "GlobalStatus" => $status,
    "UID" => $_SESSION['user_id'],
    "AdminStatus" => 0,
    "UserName" => $_SESSION['user_name']
  );
}
echo json_encode($output);
?>
