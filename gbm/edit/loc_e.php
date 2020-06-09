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







if($_REQUEST['loc_media']){
	
	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/upload_media/";
$target_file = $target_dir . basename($_FILES["media_loc"]["name"]);
$image_info = getimagesize($_FILES["media_loc"]["tmp_name"]);
 $image_width = $image_info[0];
 $image_height = $image_info[1];

if($_REQUEST['loc_media_type']=='PROFILE'){
    if($image_height>600 && $image_width>600){
		$response = array(
            "type" => "error",
            "message" => "Profile Image dimension should be within 500X500"
        );
		echo json_encode($response);
		die;
	}

 }elseif($_REQUEST['loc_media_type']=='COVER'){
	if($image_height>500 && $image_width>300){
		$response = array(
            "type" => "error",
            "message" => "Cover Image dimension should be within 470X300"
        );
		echo json_encode($response);
		die;
	}
 }else{
		 
 }
	 if(!move_uploaded_file($_FILES['media_loc']['tmp_name'],$target_file )){
		     die('Error uploading file - check destination is writeable.');
    }
	
	
	$target_url = $_SERVER['SERVER_NAME'] ."/upload_media/";
$target_urlfile = $target_url . basename($_FILES["media_loc"]["name"]);
//$trr = 'http://'.$target_urlfile;
 $url = 'http://' . $target_urlfile;
$updateMedia =  $service->accounts_locations_media;	
$updatedReviewReply = $updateMedia->listAccountsLocationsMedia($_REQUEST['acc_name']);
/* echo "<pre>";
print_r($updatedReviewReply);
die; */
//$LocationsMedia   =new Google_Service_MyBusiness_AccountsLocationsMedia_Resource($client);
 $mediaItem = new Google_Service_MyBusiness_MediaItem($client);
$mediaItem->setMediaFormat('PHOTO');
//$Google_Service_MyBusiness_LocationAssociation
$loc_Ass =	new Google_Service_MyBusiness_LocationAssociation($client);
$loc_Ass->setCategory($_REQUEST['loc_media_type']);
$mediaItem->setLocationAssociation($loc_Ass);
$mediaItem->setSourceUrl($url);
/* echo "<pre>";
print_r($mediaItem);
die;  */
$name= $_REQUEST['acc_name'];

$updatedReviewReply = $updateMedia->create($name,$mediaItem);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v4/" .$name.'/media',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $data['access_token'],
    ),
));

$res_media = curl_exec($curl);
$err = curl_error($curl);
$r_media = json_decode($res_media);

 foreach ($r_media->mediaItems as $key1 => $res1) {
$med_cat=$res1->locationAssociation->category;
if($med_cat=="COVER"){   ?>
<div id="div_image_<?php echo $key1; ?>">
                                            <img height="200px" width="200px" src='<?php echo $res1->thumbnailUrl; ?>'>	Cover
                                <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                            <div class="delete-icon"><a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>','<?php echo $res1->name  ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>
<?php  }else{	?>
	
                                        <div id="div_image_<?php echo $key1; ?>">
                                            <img height="200px" width="200px" src='<?php echo $res1->thumbnailUrl; ?>'>	
                                <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                            <div class="delete-icon">  <a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>','<?php echo $res1->name  ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>
                                        <?php
}  }
                                    	
 die;
//===============file unlink
/* if (file_exists($filename)) {
    unlink($filename);
    echo 'File '.$filename.' has been deleted';
  } else {
    echo 'Could not delete '.$filename.', file does not exist';
  } */
}


