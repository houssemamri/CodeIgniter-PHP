<?php
 include('connection.php');
if(isset($_POST)){
	extract($_POST);
	$sms_config_insert_sql = "INSERT INTO sms_config (sid,token,admin_id,number) VALUES ('".$sid."','".$token."','".$adminId."','".$number."')";
	$sms_config_insert_query = $conn->query($sms_config_insert_sql);
	if($sms_config_insert_query){
		echo "inserted";
	}
}



?>