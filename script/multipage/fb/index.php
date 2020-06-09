<?php 

include('../configdata.php');
include("../includes/functions.php");
$useremail = new Users();

?>
<?php
error_reporting(-1);
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret'appid'=>'268830656822193','appsecret'=>'3f048d39e452ea44fb9a0b917a45806c');
FacebookSession::setDefaultApplication( '268830656822193','3f048d39e452ea44fb9a0b917a45806c' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper($url.'/fb/index.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user dataGET', '/me?fields=name,email
  $request = new FacebookRequest( $session, 'GET', '/me?fields=name,email',null,'v2.5' );
  $request2 = new FacebookRequest( $session, 'GET', '/me/accounts' );
  $response2 = $request2->execute();
  $graphObject2 = $response2->getGraphObject();
  
  $fbid1 = $graphObject2->getProperty('id');
  $response = $request->execute();
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name');
		$fbfullemail = $graphObject->getProperty('email');
  //$accesst =$response.authResponse.accessToken;
  // get response
  
 // $helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $session->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
} elseif ($helper->getError()) {
  // The user denied the request
  exit;
}
   // To Get Facebook full name
	      // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['email'] = $fbfullemail; 
		$_SESSION['FBID'] = $fbid; 
      $_SESSION['FBIDl'] = $fbid1; 		
        $_SESSION['FULLNAME'] = $fbfullname;
		
		
$useremail->fblog();
//checkuser($fbfullname,$fbfullemail,$db);
	   
    /* ---- header location after session ----*/
  header("Location: index.php");
} else {
  $loginUrl = $helper->getLoginUrl(array('scope' => 'publish_actions,email,manage_pages'));
 header("Location: ".$loginUrl);
}
?>