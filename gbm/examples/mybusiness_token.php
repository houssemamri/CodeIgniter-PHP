<?php

include_once "../../connection.php";
include_once "../../common_function.php";
ini_set('display_errors', 1); 
include_once "templates/base.php";
session_start();

require_once realpath(dirname(__FILE__) . '/../../vendor/autoload.php');

 $sql="SELECT * FROM networks where network_name='google_mybusiness'";
        $result=$conn->query($sql);
$sql2="SELECT option_value FROM options where option_key='google_mybusiness_client_id'";
      $result2=$conn->query($sql2);
	  $res= $result2->fetch_assoc();
	  $sql3="SELECT option_value FROM options where option_key='google_mybusiness_client_secret'";
      $result3=$conn->query($sql3);
	  $res3= $result3->fetch_assoc();
	 $client_id_res = $res['option_value'];
	 $client_secret_res = $res3['option_value'];
	  
		// $row=$result->fetch_assoc();
while($row=$result->fetch_assoc())
          {
		
$client_id = $client_id_res;
$client_secret = $client_secret_res;
$redirect_uri = base_url2().'gbm/examples/idtken_mybusiness.php';

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
        $refreshToken = $row['secret'];

        // refresh the token
        $client->refreshToken($refreshToken);
    }

$oauth=$client->getAccessToken();
 $access_token=$oauth['access_token'];
 $expires_in=$oauth['expires_in'];

 $created=$oauth['created'];
 	
$id=$row['network_id'];

 $sql1="UPDATE networks SET token='" . $access_token . "',expires='" . $expires_in . "',created='" . $created . "' WHERE network_id=" . $id ." and network_name='google_mybusiness'";
$conn->query($sql1);
$conn->close();
echo "done";	
//echo "<script> alert('mybusiness');</script>";
		  }	

?>