<?php
ini_set('display_errors', 1); 
include_once "../../connection.php";

include_once "templates/base.php";
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
$redirect_uri = 'http://review-thunder.com/gbm/examples/idtoken.php';
define('APPLICATION_NAME', 'User Query - Google My Business API');
define('CREDENTIALS_PATH', 'credentials.json');
define('CLIENT_SECRET_PATH', 'credentials.json');
$client = new Google_Client();
//$client->setApplicationName("My Application");
//$client->setDeveloperKey("AIzaSyBNMMFtrkLcnMTu9MdGAZVXJ1uOl3h2ogM");

//$redirect_uri = '<YOUR_REDIRECT_URI>';

//$client->setApplicationName(APPLICATION_NAME);
//$client->setAuthConfigFile(CLIENT_SECRET_PATH);
//$client->addScope("https://www.googleapis.com/auth/plus.business.manage");
$client->setRedirectUri($redirect_uri);
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
  $_SESSION['access_token'] = $client->getAccessToken();
 

  $service = new Google_Service_Mybusiness($client);
  echo "<pre>";
/*   print_r($service);
print '<br>'; */
$reviews = $service->accounts;

/* $listReviewsResponse = $reviews->listAccountsLocationsReviews('accounts/100928649975105038548/locations/12481351387678745559');

$reviewsList = $listReviewsResponse->getReviews(); */
$accounts = $service->accounts;
$accountsList = $accounts->listAccounts()->getAccounts();
$account = $accountsList[0];
print_r($account);
die;



                $test2 = $service->accounts_locations->listAccountsLocations($test[0]['name']);
                $test3 = $service->accounts_locations_reviews->listAccountsLocationsReviews($test2[0]['name']);


                
                print_r($test2);
                print_r($test3);

                print 'Done';
die;
 
 
 
  /* $sql="INSERT INTO oauth_user(access_token,expires_in,created,refresh_token) VALUES ('" . $access_token . "','" . $expires_in . "','" . $created . "','".$refresh_token."')";
 
$conn->query($sql);
$conn->close();
 
   
   
 
  $_SESSION['code'] = $_GET['code'];
  $_SESSION['auth'] = json_decode($client->getAccessToken());
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL)); */
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
if ($client->getAccessToken()) {
	//echo "tttt"; die;
	
  //$_SESSION['access_token'] = $client->getAccessToken();
 // $token_data = $client->verifyIdToken()->getAttributes();
}

echo pageHeader("User Query - Retrieving An Id Token");
	
if (  $client_id == '477160079094-8c63vdhok6cok7asoh9d2fsr020pvvs4.apps.googleusercontent.com' || $client_secret == 'goaLNEz9ym13w_lIXd0jWS_W'  || $redirect_uri == 'http://review-thunder.com/gbm/examples/idtoken.php' ) {
  echo missingClientSecretsWarning();
}
?>
<div class="box">
  <div class="request">
<?php
if (isset($authUrl)) {

  echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
} else { 
print_r($_SESSION);
  echo "<a class='logout' href='?logout'>Logout</a>";
}
?>
  </div>

  <div class="data">
<?php 
if (isset($token_data)) {
	
  var_dump($token_data);
}
?>
  </div>
</div>
<?php
//echo pageFooter(__FILE__);
