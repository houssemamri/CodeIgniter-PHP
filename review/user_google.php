<?php
include_once "connection.php";
ini_set('display_errors', 1); 
include_once "gbm/templates/base.php";
session_start();

require_once ('gbm/vendor/autoload.php');
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM `oauth_user` where user_id=".$_SESSION['user_id'];
	$result=$conn->query($sql);
   $row=$result->fetch_array();
/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 if (isset($_REQUEST['ajax_post'])) {
$client_id = $_REQUEST['client_id'];
$client_secret = $_REQUEST['client_secret'];
$_SESSION['client_id'] = $_REQUEST['client_id'];
$_SESSION['client_secret'] = $_REQUEST['client_secret'];
 }else{
$client_id = $row['client_id'];
$client_secret = $row['client_secret'];	 
	 
	 
 }
 
$redirect_uri = 'http://review-thunder.com/user_google.php';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
 $client->setAccessType('offline'); 

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['access_token']);
  }

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
	
  $client->authenticate($_GET['code']);
$oauth=$client->getAccessToken();
//print_r($client->getAccessToken());

 $access_token=$oauth['access_token'];
 $expires_in=$oauth['expires_in'];
 $refresh_token=$oauth['refresh_token'];
 $created=$oauth['created'];
 
 $client_id=$_SESSION['client_id'] ;
$client_secret=$_SESSION['client_secret'] ;
$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM `oauth_user` where user_id=".$_SESSION['user_id'];
	$result=$conn->query($sql);
   $row=$result->fetch_array();
	
		 if(empty($row)){
  $sql="INSERT INTO oauth_user(client_id,client_secret,user_id,access_token,expires_in,created,refresh_token) VALUES ('" . $client_id . "','" . $client_secret . "','" . $user_id . "','" . $access_token . "','" . $expires_in . "','" . $created . "','".$refresh_token."')";
  $conn->query($sql);
$conn->close();
		 }else{
			 $id=$row['id'];
$sql1="UPDATE oauth_user SET access_token='" . $access_token . "',expires_in='" . $expires_in . "',created='" . $created . "' WHERE id=" . $id;
$conn->query($sql1);
$conn->close(); 
		 }

 
   
 
  $_SESSION['access_token'] = $client->getAccessToken();
  $_SESSION['code'] = $_GET['code'];
  $_SESSION['auth'] = $client->getAccessToken();
  $redirect = 'http://review-thunder.com/profile.php?id='.$user_id;
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
  
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}


/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/
	

?>
<div class="row full-row">
 <h6 style="font-weight:bold;">Retrieving An Id Token:</h6>
      
  <br /><br />
  <?php
if (isset($authUrl)) { 
	echo "<a class='btn btn-lg btn-primary' style='display:table;margin:0 auto;'  href='" . $authUrl . "'>Connect Me!</a>";

}else{ ?>
  <br /><br />
	<a class="btn btn-lg btn-primary" onclick="logout_google();"  style="display:table;margin:0 auto;"   href='javascript:void(0);'>Logout</a>

<?php }  ?>
  </div> 



 