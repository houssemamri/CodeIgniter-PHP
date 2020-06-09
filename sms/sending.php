<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
include_once 'email/includes/db.class.php';


require  __DIR__ .'/twilio-php-master/Twilio/autoload.php';

$id = $_SESSION['user_id'];

if(isset($_POST['send'])){
	
	extract($_POST);
	
	
	
 $sid    = "AC3ab6c9f32ab74372ec2e7b610ee59cb6";
$token  = "877ace7760e5bd6ced94848b8f46d219";
$client = new Twilio\Rest\Client($sid, $token);

//print_r($client);

	for($l=0;$l<count($mob_number);$l++){
		$sqlGroupId = "select * from EmailListSub where LID='".$mob_number[$l]."'";
		/*echo $sqlGroupId;die("here");*/
		$queryGroupId = mysqli_query($conn,$sqlGroupId);
		
   while($result = mysqli_fetch_assoc($queryGroupId)){
   	$sqlEmail="select mobile from EmailList where EID='".$result['EID']."'";
   	//echo $sqlEmail;die("here");
	$query2 = mysqli_query($conn,$sqlEmail);
	$emailName=mysqli_fetch_assoc($query2);
   	//print_r($emailName);die("here");
$mobile = $emailName['mobile'];

$message = $client->messages->create($mobile,array(
                              "from" => "+16194042260",
                               "body" => $_POST['msg']
                               
                           )
                  );

                 

       
   if($message->sid){
   		$sql = "INSERT INTO sms_log( receive_number, group_id , msg, sid, send_time, send_date, owner_sid, from_number, error_message, admin_id) VALUES ('".$message->to."', '".$result['EID']."' ,'".$message->body."','".$message->sid."','".date("H:i:s")."','".date("d-m-y")."','".$message->accountSid."','".$message->from."','".$message->errorMessage."','".$_SESSION['user_id']."')";
   		
   	//	echo $sql;die();
   		
   		$query = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
   		
   }   
	
}

	}           
}

?>