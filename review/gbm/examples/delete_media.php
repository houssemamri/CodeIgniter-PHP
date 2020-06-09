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
  

//$reviews = $service->accounts;

//----------------- Review Post -----------------------
$media = $service->accounts_locations_media;

$medialist = $media->listAccountsLocationsMedia($_REQUEST['name']);
$medialis2 = $medialist->getMediaItems();


$res = $media->delete($medialis2[$_REQUEST['key']]->name);
print_r($res);
die;//print_r($updatedReviewReply->updateTime);







