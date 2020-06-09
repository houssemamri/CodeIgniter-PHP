<?php
ini_set('display_errors', 1); 
include_once "../../connection.php";

include_once "templates/base.php";
require_once realpath(dirname(__FILE__) . '/../autoload.php');
require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');
include_once "MyBusiness.php";
session_start();



/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
$client_id = '477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com';
$client_secret = 'goaLNEz9ym13w_lIXd0jWS_W';
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



$client->setAccessToken($_SESSION['access_token']);

 
 
  $service = new Google_Service_Mybusiness($client);
  echo "<pre>";

$reviews = $service->accounts;

/* $listReviewsResponse = $reviews->listAccountsLocationsReviews('accounts/100928649975105038548/locations/12481351387678745559');

$reviewsList = $listReviewsResponse->getReviews(); */

//-----------------Account Get -----------------------
$accounts = $service->accounts;
$accountsList = $accounts->listAccounts()->getAccounts();
$account = $accountsList[0];
//print_r($account);


//-----------------locations Get -----------------------
$locations = $service->accounts_locations;
$locationsList = $locations->listAccountsLocations($account->name)->getLocations();
$location = $locationsList[0];
//print_r($location);

//-----------------All Reviews Get -----------------------
$reviews = $service->accounts_locations_reviews;
$listReviewsResponse = $reviews->listAccountsLocationsReviews($location->name);
$reviewsList = $listReviewsResponse->getReviews();
 $name= $location->name.'/reviews/'.$reviewsList[0]->reviewId;

/*  print_r($reviewsList);
die; */

echo $location->name.'/media/ChIJ_xUwvpL0ikcRPCL1-cPSIXQ';

$media = $service->accounts_locations_media;
//$media = $media->photos;

//$name=$location->name.'/reviews/'.$reviewsList[0]->reviewId;
$medialist = $media->listAccountsLocationsMedia($location->name);
$medialis2 = $medialist->getMediaItems();

print_r($medialis2);

 /* $comment=array('comment'=>'test my side');
$reply=$reviews->updateReply($name,$comment);
 */
 //$review=$reviews->reviews;

/* $reviewReply = new Google_Service_MyBusiness_ReviewReply($client);

$reviewReply->setComment("Thank you for visiting our business!");

$name=$location->name.'/reviews/'.$reviewsList[0]->reviewId;
$updatedReviewReply = $reviews->updateReply($name,$reviewReply); */

//print_r($updatedReviewReply);

die;






