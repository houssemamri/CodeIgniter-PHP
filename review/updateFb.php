<?php
include('connection.php');
$user_id=$_POST['user_id'];
$fb_link=$_POST['fb_link'];
$fb_app_id=$_POST['fb_app_id'];
$fb_app_secret=$_POST['fb_app_secret'];
$fb_page_id=$_POST['fb_page_id'];
$tabletype=$_POST['tabletype'];
if($tabletype=="Save"){
	$sql="INSERT INTO fb_setting(user_id,fb_link,fb_app_id,fb_page_id,fb_app_secret) VALUES ('" . $user_id . "','" . $fb_link . "','" . $fb_app_id . "','" . $fb_page_id . "','" . $fb_app_secret . "')";
 $conn->query($sql); 
}else{
$sql="UPDATE fb_setting SET  fb_link='" . $fb_link . "', fb_app_id='" . $fb_app_id . "', fb_page_id='" . $fb_page_id . "', fb_app_secret='" . $fb_app_secret . "'  WHERE user_id=" . $user_id;
$conn->query($sql);

}
$conn->close();
?>