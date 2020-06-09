<?php
ini_set('display_errors', 1); 
include_once "../../connection.php";

include_once "templates/base.php";
//require_once realpath(dirname(__FILE__) . '/../autoload.php');
require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
include_once "MyBusiness.php";
 
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
$redirect_uri = 'https://review-thunder.com/gbm/examples/idtoken.php';

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
  

//$reviews = $service->accounts;

//----------------- Review Post -----------------------
$reviews = $service->accounts_locations_reviews;

 


$reviewReply = new Google_Service_MyBusiness_ReviewReply($client);

$reviewReply->setComment($_REQUEST['text']);

$name= $_REQUEST['name'].'/reviews/'.$_REQUEST['id'];
$updatedReviewReply = $reviews->updateReply($name,$reviewReply);

//print_r($updatedReviewReply->updateTime);
if(!empty($updatedReviewReply->updateTime)){
echo "done"; 	
	
}

die;






