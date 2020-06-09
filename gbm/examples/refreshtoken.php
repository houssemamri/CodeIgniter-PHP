<?php

include_once "../../connection.php";
include_once "../../common_function.php";
ini_set('display_errors', 1); 
include_once "templates/base.php";
session_start();
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM `oauth_user` where user_id=1";
	$result=$conn->query($sql);
   $data=$result->fetch_array();
//$access=	json_decode($_SESSION['access_token']);
  $client_id= $data['client_id'];
  $client_secret= $data['client_secret'];
require_once realpath(dirname(__FILE__) . '/../../vendor/autoload.php');

//$client_id = '477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com';
//$client_secret = 'JSs8td28gVaxPgvmgG71PZ_a';
$redirect_uri = base_url2().'gbm/examples/idtoken.php';

$client = new Google_Client();

$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
 $client->setAccessType('offline'); 



$code=$_SESSION['code'];



    // this line gets the new token if the cookie token was not present
    // otherwise, the same cookie token
   $token = $_SESSION['auth'];
	
//$refresh_kotan
    if($client->isAccessTokenExpired()){  // if token expired
	
        $refreshToken = $data['refresh_token'];
	  

        // refresh the token
      $res= $client->refreshToken($refreshToken);
		// print_r($res);
		// die;
		
    }
	
	
	$sql="SELECT * FROM `oauth_user`";
	$result=$conn->query($sql);
  while($row=$result->fetch_assoc()){
    $data= $row;
  }
 
	

$oauth=$client->getAccessToken();
$access_token=$oauth['access_token'];
 $expires_in=$oauth['expires_in'];

 $created=$oauth['created'];
 $refresh_token=$oauth['refresh_token'];
 	
$id=$data['id'];

 $sql1="UPDATE oauth_user SET access_token='" . $access_token . "',expires_in='" . $expires_in . "',created='" . $created . "' WHERE id=" . $id;
$conn->query($sql1);
$conn->close();
echo "done";	
	

?>