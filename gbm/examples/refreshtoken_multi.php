<?php

include_once "../../connection.php";
include_once "../../common_function.php";
ini_set('display_errors', 1); 
include_once "templates/base.php";
session_start();

require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');

 $sql="SELECT * FROM oauth_user ";
        $result=$conn->query($sql);
		// $row=$result->fetch_assoc();
while($row=$result->fetch_assoc())
          {
		
$client_id = $row['client_id'];
$client_secret = $row['client_secret'];
$redirect_uri = base_url2().'gbm/examples/idtoken.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
 $client->setAccessType('offline'); 



//$code=$row['code'];



    // this line gets the new token if the cookie token was not present
    // otherwise, the same cookie token
    $token = $_SESSION['auth'];
	
//$refresh_kotan
    if($client->isAccessTokenExpired()){  // if token expired
        $refreshToken = $row['refresh_token'];

        // refresh the token
        $client->refreshToken($refreshToken);
    }

$oauth=$client->getAccessToken();
 $access_token=$oauth['access_token'];
 $expires_in=$oauth['expires_in'];

 $created=$oauth['created'];
 	
$id=$row['id'];

 $sql1="UPDATE oauth_user SET access_token='" . $access_token . "',expires_in='" . $expires_in . "',created='" . $created . "' WHERE id=" . $id;
$conn->query($sql1);
$conn->close();
echo "done";	
echo "<script> alert('old');</script>";
		  }	

?>