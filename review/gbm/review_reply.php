<?php

include_once "../connection.php";
ini_set('display_errors', 1); 
include_once "templates/base.php";
session_start();

require_once realpath(dirname(__FILE__) . '/autoload.php');
$sql="SELECT * FROM `oauth_user`";
	$result=$conn->query($sql);
  while($row=$result->fetch_assoc()){
    $data= $row;
  }

$code=$data['code'];

echo $token = $data['access_token'];

$client_id = '477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com';
$client_secret = 'goaLNEz9ym13w_lIXd0jWS_W';
$redirect_uri = 'http://review-thunder.com/gbm/examples/idtoken.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
 $client->setAccessType('offline'); 



$client1 = new Google_Service_AndroidPublisher($client);



        //$refreshToken = $token->refresh_token;
       
    //accounts/100928649975105038548/locations/12481351387678745559/reviews/AIe9_BGIy_plKfaZrItPyyQZNLvsd8bHrpzsdAeR29UMCmhwyYauEy-46TInvtoWLqfj_BCDU0BBAKXYGG3RukVDpzkvDHGaBb3sH9ueGxGwuDACN517VGg/reply
    $reviews = $client1->listReviews('accounts/100928649975105038548/locations/12481351387678745559/');
	print_r($reviews);
/*     $token = $_SESSION['auth'];
  $client->refreshToken($refreshToken);	 */

	
	
	

?>