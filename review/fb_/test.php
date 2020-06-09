<?php

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
$appsecret_proof= hash_hmac('sha256', 'EAAGAXXHqEVQBAEDLvBiOwEW4Q8SgCMzcgzb8UO8xenaDfDZBPiLkh023O19i0hU1URiMiTP3WIZCI5c6xDKiVRH896Ud9rDdm0yhsTXjluZCzKPTpzcZCIhCVhg6n9UgxAZBR2pEyZBWFfLufLFB3yZC6y3KCaKyFUDj623pUYBmz1MBbBqHqnV', '95833c8560de19c30da6a653957e1c2c');
$fb = new \Facebook\Facebook([
  'app_id' => '422613808189780',
  'app_secret' => '95833c8560de19c30da6a653957e1c2c',
  'default_graph_version' => 'v2.10',
 //'default_access_token' => 'EAAGAXXHqEVQBANRFXJ9ZAmFYI0QT0XBP5KaEvZBC6NA0UnAQEB8XjE0vZBRtX0dds9lEbitMdACjPsPBadZCkbrsOkTgL9XLFjILgTlWnuKMRQ3mjOnd4XDE2SrIWyJIEt87ZCV4v59wVTzknZARubOCFPlZCjOqjo7XZC91cVAZAlZCHr8gjdaGum',
 'appsecret_proof' =>$appsecret_proof

 // optional
]);
$helper = $fb->getCanvasHelper();
// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();


//$accessToken = $helper->getAccessToken();
try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
 $response = $fb->get('/me', 'EAAGAXXHqEVQBAEDLvBiOwEW4Q8SgCMzcgzb8UO8xenaDfDZBPiLkh023O19i0hU1URiMiTP3WIZCI5c6xDKiVRH896Ud9rDdm0yhsTXjluZCzKPTpzcZCIhCVhg6n9UgxAZBR2pEyZBWFfLufLFB3yZC6y3KCaKyFUDj623pUYBmz1MBbBqHqnV');  
   /* $response = $fb->get(
    '/178585066172367/locations',
'EAAGAXXHqEVQBAOPMVMSG9UlIld0w3tueoNp7qDSgIaKvfRlmnoEIKAUbezronRZARFfLRZBijbJoD2eh1lDIBOiqp0g2L89xIMqhzeqHYIw8GQzaUGQsCAoVXEJf6UUghklgbrIMN5HmP8zZC5fCnBFU7ZC80XSJGd4tIM31yYuQGtlmyd04'
  ); */
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
/* echo "<pre>";
print_r($me);echo "<pre>";
print_r($me);echo "<pre>";
print_r($me); */
echo 'Logged in as ' . $me->getName();
die;
?>