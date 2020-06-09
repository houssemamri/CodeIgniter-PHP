<?php

ini_set('display_errors', 1); 
include_once "../../connection.php";

include_once realpath(dirname(__FILE__) ."/../examples/templates/base.php");
//require_once realpath(dirname(__FILE__) . '/../autoload.php');
require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');

include_once realpath(dirname(__FILE__) ."/../MyBusiness.php");
 
session_start();

    $sql="SELECT * FROM oauth_user WHERE user_id=".$_SESSION['user_id'];
	$result=$conn->query($sql);
    $data=$result->fetch_array();

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
$client_id = $data['client_id'];
$client_secret = $data['client_secret'];
$redirect_uri = 'http://review-thunder.com/gbm/examples/idtoken.php';

$client = new Google_Client();
//$client->addScope("https://www.googleapis.com/auth/plus.business.manage");
$client->setRedirectUri($redirect_uri);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
 $client->setAccessType('offline'); 


$client->setAccessToken($data['access_token']);
 
 
$service = new Google_Service_Mybusiness($client);
//----------------- Update Location -----------------------

$updateLocation =  $service->accounts_locations;
$reviewReply = new Google_Service_MyBusiness_Location($client);
//$name="accounts/100928649975105038548/locations/12481351387678745559";
if(isset($_REQUEST['locationName'])){

 $reviewReply->setLocationName($_REQUEST['locationName']);
 $opt_param=array('updateMask'=>'locationName',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['primaryPhone'])){

 $reviewReply->setPrimaryPhone($_REQUEST['primaryPhone']);
 $opt_param=array('updateMask'=>'primaryPhone',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['websiteUrl'])){
	
 $reviewReply->setWebsiteUrl($_REQUEST['websiteUrl']);
 $opt_param=array('updateMask'=>'websiteUrl',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['cat'])){
	

$catdata =	new Google_Service_MyBusiness_Category($client);
$catdata->setCategoryId($_REQUEST['categoryId']);
$catdata->setDisplayName($_REQUEST['cat_name']);

$reviewReply->setPrimaryCategory($catdata);

 $opt_param=array('updateMask'=>'primaryCategory',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['address'])){
	

$postAddress =	new Google_Service_MyBusiness_PostalAddress($client);
$postAddress->setAddressLines($_REQUEST['addressLines']);
$postAddress->setPostalCode($_REQUEST['postalCode']);
$postAddress->setLocality($_REQUEST['locality']);
$postAddress->setRegionCode($_REQUEST['country']);
$reviewReply->setAddress($postAddress);

 $opt_param=array('updateMask'=>'address',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['storeCode'])){ 
$reviewReply->setStoreCode($_REQUEST['storeCode']);
 $opt_param=array('updateMask'=>'storeCode',
				'validateOnly'=>false,
				);
}
if(isset($_REQUEST['label'])){ 
$reviewReply->setLabels($_REQUEST['labels']);
 $opt_param=array('updateMask'=>'labels',
				'validateOnly'=>false,
				);
				
				
}
if(isset($_REQUEST['open_date'])){
	$year = $_POST['year'];
	$month = $_POST['month'];
	$day = $_POST['day'];
	
	$add_open_date = new Google_Service_MyBusiness_Date($client);
$add_open_date->setDay($day);
$add_open_date->setMonth($month);
$add_open_date->setYear($year);
$openingDate = new Google_Service_MyBusiness_OpenInfo($client);
$openingDate->setOpeningDate($add_open_date);
$reviewReply->setOpenInfo($openingDate);
 $opt_param=array('updateMask'=>'openInfo',
				 'validateOnly'=>false,
				 );
$date= $year.'-'.$month.'-'.$day;

$openings =  date("F j Y", strtotime($date)); 

echo $openings;



	
	
}
if(isset($_REQUEST['additionalPhones'])){
	$adPhone = new Google_Service_MyBusiness_AdWordsLocationExtensions($client);	
 $adPhone->setAdPhone($_REQUEST['additionalPhones']);
	 $reviewReply->setAdWordsLocationExtensions($adPhone);
  $opt_param=array('updateMask'=>'adWordsLocationExtensions',
				 'validateOnly'=>false,
				 );

}





if(isset($_REQUEST['add_hours'])){
	$businessHours = new Google_Service_MyBusiness_BusinessHours();
 $timePeriods = array();
 $data = $_POST['periods'];

 $days = array("SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY","FRIDAY","SATURDAY");
 foreach ($days as $day) {
	$sl=strtolower($day);
	$checked='check_'.$sl;
	if(isset($data[$sl][$checked])){
 foreach($data[$sl] as $key=> $p){
	 
	 if(!empty($p['openTime'])  && !empty($p['closeTime'])){
   $timePeriod = new Google_Service_MyBusiness_TimePeriod();
   $timePeriod->setOpenDay($day);
   $timePeriod->setOpenTime($p['openTime']);
   $timePeriod->setCloseTime($p['closeTime']);
   $timePeriod->setCloseDay($day);
   $timePeriods[] = $timePeriod;
	 }
 }
	}
 }
 
 $businessHours->setPeriods($timePeriods);
 $reviewReply->setRegularHours($businessHours);
 $opt_param=array('updateMask'=>'regularHours',
				'validateOnly'=>false,
				);
	
}
$name= $_REQUEST['acc_name'];
$updatedReviewReply = $updateLocation->patch($name,$reviewReply,$opt_param);






if(isset($_REQUEST['label'])){

$da=$updatedReviewReply->getLabels();
   ?>
   
   <?php if(!isset($da)){   ?><span class="advanced-span">Labels</span><a id="store_label" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
												<?php }else{  ?>
												<span class="advanced-span">Labels</span><a id="store_label" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
												<ul>
												<?php
												foreach($da  as $p){
												 ?>
												 <li>
												 <?php
												echo $p;
												
												
												?>
												</li>
												
												<?php	}?>
												</ul>
 <?php  } 
 
die;
}

if($_REQUEST['loc_media']){
	
	
	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/upload_media/";
$target_file = $target_dir . basename($_FILES["media_loc"]["name"]);

	 if(!move_uploaded_file($_FILES['media_loc']['tmp_name'],$target_file )){
    die('Error uploading file - check destination is writeable.');
    }else{
	
		
	}
	/* echo $target_file ;
	die; */
$updateMedia =  $service->accounts_locations_media;	
//$LocationsMedia   =new Google_Service_MyBusiness_AccountsLocationsMedia_Resource($client);
 $mediaItem = new Google_Service_MyBusiness_MediaItem($client);
$mediaItem->setMediaFormat('PHOTO');
//$Google_Service_MyBusiness_LocationAssociation
$loc_Ass =	new Google_Service_MyBusiness_LocationAssociation($client);
$loc_Ass->setCategory('INTERIOR');
$mediaItem->setLocationAssociation($loc_Ass);
$mediaItem->setSourceUrl('http://review-thunder.com/upload_media/Hydrangeas.jpg');
$name= $_REQUEST['acc_name'];

$updatedReviewReply = $updateMedia->create($name,$mediaItem);
echo "<pre>";
print_r($updatedReviewReply);
die;
//===============file unlink
/* if (file_exists($filename)) {
    unlink($filename);
    echo 'File '.$filename.' has been deleted';
  } else {
    echo 'Could not delete '.$filename.', file does not exist';
  } */
}


if(isset($_REQUEST['add_hours'])){ 

 
	$da=$updatedReviewReply->getRegularHours()->getPeriods();
	
	if(!isset($da)){   ?><i class="fa fal fa-clock" aria-hidden="true"></i><span id="html_address">Add hours</span><a id="btn_hours" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
												<?php }else{  ?>
												<i class="fa fal fa-clock" aria-hidden="true"></i><a id="btn_hours" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
												<div  class="html_time"><?php
                                            $days=array("sunday","monday", "tuesday", "wednesday", "thursday", "friday","saturday");
											
												foreach($da  as $p){ 
 
												if(in_array(strtolower($p->openDay),$days)){
													if($p->closeTime=="24:00"){
												$resnew[strtolower($p->openDay)]=$p->openDay." Open 24 hours";
													}else{
														$s_time=date('h:i a', strtotime($p->openTime));
														$e_time=date('h:i a', strtotime($p->closeTime));
													$resnew[strtolower($p->openDay)]= $p->openDay."  ".$s_time." - ".$e_time;	
													}
													}}
													/* echo "<pre>";
													print_r($resnew); */
												foreach($days as $d){
													if(isset($resnew[$d])){
														echo $resnew[$d].'<br>';
													    													
													}else{
														echo strtoupper($d).' Closed <br>';
														
													}										
													
												} ?></div>
												<?php	} ?>
	
	
<?php }
die;
if(!empty($updatedReviewReply->updateTime)){
echo "done"; 	
	
}

die;