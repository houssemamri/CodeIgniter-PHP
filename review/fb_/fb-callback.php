<?php
include('../connection.php');
ini_set('display_errors', 1); 
session_start();
require_once ('vendor/autoload.php');
 $user_id=$_SESSION['user_id'];
$sql="SELECT * FROM fb_setting WHERE user_id=".$user_id;

	$result=$conn->query($sql);
   $row=$result->fetch_array();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
$app_id = $row['fb_app_id'];
$app_secret = $row['fb_app_secret'];	 
$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.10',
  ]);
$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);


// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app_id);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
 $tokenMetadata->validateExpiration();

/* if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $Long_accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }} */
$Long_accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  /* echo '<h3>Long-lived</h3>';
  var_dump($Long_accessToken->getValue()); */


 $_SESSION['fb_access_token'] = (string) $accessToken;

 $access_token=(string) $accessToken;
 $token_long_lived =(string) $Long_accessToken->getValue();
$token_created_date =(string) $tokenMetadata->getIssuedAt()->date ;
$fb_user_id=$tokenMetadata->getUserId();
 
 	
$id=$row['id'];

 $sql1="UPDATE fb_setting SET access_token='" . $access_token . "',fb_user_id='" . $fb_user_id . "',token_created_date ='" . $token_created_date . "',token_long_lived ='" . $token_long_lived  . "' WHERE id=" . $id;
$conn->query($sql1);
$conn->close();
 $redirect = 'http://review-thunder.com/review/profile.php?id='.$user_id;
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
echo "done"; 
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');