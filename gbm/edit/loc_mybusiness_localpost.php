<?php

include_once "../../connection.php";
include_once "../../common_function.php";
ini_set('display_errors', 1); 
include_once realpath(dirname(__FILE__) ."/../examples/templates/base.php");
//require_once realpath(dirname(__FILE__) . '/../autoload.php');
require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');

include_once realpath(dirname(__FILE__) ."/../MyBusiness.php");
session_start();


$user_id=$_SESSION['user_id'];
 $sql="SELECT * FROM networks where network_name='google_mybusiness' and user_id=".$user_id;
        $result=$conn->query($sql);
		$row=$result->fetch_assoc();
$sql2="SELECT option_value FROM options where option_key='google_mybusiness_client_id'";
      $result2=$conn->query($sql2);
	  $res= $result2->fetch_assoc();
	  $sql3="SELECT option_value FROM options where option_key='google_mybusiness_client_secret'";
      $result3=$conn->query($sql3);
	  $res3= $result3->fetch_assoc();
	 $client_id_res = $res['option_value'];
	 $client_secret_res = $res3['option_value'];
	 
	 $client_id = $client_id_res;
$client_secret = $client_secret_res;
$redirect_uri = base_url2().'gbm/examples/idtken_mybusiness.php';

$client = new Google_Client();
$client->setRedirectUri($redirect_uri);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
$client->setAccessType('offline'); 
$client->setAccessToken($row['token']);

$service = new Google_Service_Mybusiness($client);
//----------------- Update Location -----------------------

$updateLocation =  $service->accounts_locations_localPosts;
$localPost = new Google_Service_MyBusiness_LocalPost($client);
$event = new Google_Service_MyBusiness_LocalPostEvent($client);
$schedule = new Google_Service_MyBusiness_TimeInterval($client);
$endDate = new Google_Service_MyBusiness_Date($client);
$startDate = new Google_Service_MyBusiness_Date($client);
$endTime = new Google_Service_MyBusiness_TimeOfDay($client);
$startTime = new Google_Service_MyBusiness_TimeOfDay($client);
$callToAction = new Google_Service_MyBusiness_CallToAction($client);
$offerType = new Google_Service_MyBusiness_LocalPostOffer($client);
$media = new Google_Service_MyBusiness_MediaItem($client);
$name=$_POST['loc_name'];
$localPost->setLanguageCode('en-US');
$localPost->setSummary($_POST['post_detail']);

if($_POST['TopicType']=="STANDARD"){
$callToAction->setActionType($_POST['callToAction']);	
$url =$_POST['post_url'] ;
$callToAction->setUrl($url);
$localPost->setCallToAction($callToAction);

}
if($_POST['TopicType']=="EVENT"){
	$callToAction->setActionType($_POST['callToAction']);
	$event->setTitle($_POST['event_title']);
$url =$_POST['post_url'] ;
$callToAction->setUrl($url);
$localPost->setCallToAction($callToAction);
	

$start_date=strtotime($_POST['start_date']);
$end_date=strtotime($_POST['end_date']);
$start_time=strtotime($_POST['start_time']);
$end_time=strtotime($_POST['end_time']);

 $s_month=date("m",$start_date);
 $s_year=date("Y",$start_date);
 $s_day=date("d",$start_date);
 $e_month=date("m",$end_date);
 $e_year=date("Y",$end_date);
 $e_day=date("d",$end_date);



 $s_h=date("h",$start_time);
 $s_i=date("i",$start_time);
 $s_s=date("s",$start_time);
 
  $e_h=date("h",$end_time);
  $e_i=date("i",$end_time);
  $e_s=date("s",$end_time);
 


	
$endDate->setYear($e_year);
$endDate->setMonth($e_month);
$endDate->setDay($e_day);
 $endTime->setHours($e_h);
$endTime->setMinutes($e_i);
$endTime->setNanos('0');
$endTime->setSeconds($e_s); 
$startDate->setDay($s_day);
$startDate->setMonth($s_month);
$startDate->setYear($s_year);
 $startTime->setHours($s_h);
$startTime->setMinutes($s_i);
$startTime->setNanos('0');
$startTime->setSeconds($s_s); 

$schedule->setEndDate($endDate);
$schedule->setEndTime($endTime);
$schedule->setStartDate($startDate);
$schedule->setStartTime($startTime);

$event->setSchedule($schedule);
$localPost->setEvent($event);


}

 if($_POST['TopicType']=="OFFER"){

	
	
$event->setTitle($_POST['event_title']);

	
	
$start_date=strtotime($_POST['start_date']);
$end_date=strtotime($_POST['end_date']);
$start_time=strtotime($_POST['start_time']);
$end_time=strtotime($_POST['end_time']);

 $s_month=date("m",$start_date);
 $s_year=date("Y",$start_date);
 $s_day=date("d",$start_date);
 $e_month=date("m",$end_date);
 $e_year=date("Y",$end_date);
 $e_day=date("d",$end_date);



 $s_h=date("h",$start_time);
 $s_i=date("i",$start_time);
 $s_s=date("s",$start_time);
 
  $e_h=date("h",$end_time);
  $e_i=date("i",$end_time);
  $e_s=date("s",$end_time);
 


	
$endDate->setYear($e_year);
$endDate->setMonth($e_month);
$endDate->setDay($e_day);
 $endTime->setHours($e_h);
$endTime->setMinutes($e_i);
$endTime->setNanos('0');
$endTime->setSeconds($e_s); 
$startDate->setDay($s_day);
$startDate->setMonth($s_month);
$startDate->setYear($s_year);
 $startTime->setHours($s_h);
$startTime->setMinutes($s_i);
$startTime->setNanos('0');
$startTime->setSeconds($s_s); 

$schedule->setEndDate($endDate);
$schedule->setEndTime($endTime);
$schedule->setStartDate($startDate);
$schedule->setStartTime($startTime);

$event->setSchedule($schedule);
$offerType->setCouponCode($_POST['couponCode']);
$offerType->setRedeemOnlineUrl($_POST['redeemOnlineUrl']);
$offerType->setTermsConditions($_POST['termsConditions']);	
$localPost->setEvent($event);
$localPost->setOffer($offerType);
}

 if(!empty($_FILES['post_img']['name'])){
	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/upload_media/";
$target_file = $target_dir . basename($_FILES["post_img"]["name"]);
$image_info = getimagesize($_FILES["post_img"]["tmp_name"]);
 $image_width = $image_info[0];
 $image_height = $image_info[1];
 if(!move_uploaded_file($_FILES['post_img']['tmp_name'],$target_file )){
		     die('Error uploading file - check destination is writeable.');
    }	
$target_url = $_SERVER['SERVER_NAME'] ."/upload_media/";
$target_urlfile = $target_url . basename($_FILES["post_img"]["name"]);
 $mediaurl = 'http://' . $target_urlfile;

$media->setMediaFormat("PHOTO");
$media->setName($_FILES["post_img"]["name"]);
$media->setSourceUrl($mediaurl);
$media->setThumbnailUrl($mediaurl);
$media->setGoogleUrl($mediaurl);
$localPost->setMedia($media);
}	

//



$localPost->setTopicType($_POST['TopicType']);



$new=$updateLocation->create($name, $localPost); 

?>
