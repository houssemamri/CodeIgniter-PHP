<?php
 include('connection.php');
if(isset($_POST)){
	/*echo "<pre>";
	print_r($_POST);
	die();*/
	extract($_POST);
	$sms_config_update_sql = "UPDATE sms_config SET sid= '".$sid."' ,token= '".$token."' ,admin_id= '".$adminId."' ,number= '".$number."' WHERE id= '".$idd."'";
	
	$sms_config_update_query = $conn->query($sms_config_update_sql);
	if($sms_config_update_query){
		echo "updated";
	}
}



?>