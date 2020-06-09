<?php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
$fb = new Facebook\Facebook([
  'app_id' => '422613808189780',
  'app_secret' => '95833c8560de19c30da6a653957e1c2c',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getCanvasHelper();
echo "<pre>";
print_r($helper->getSignedRequest());

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
  echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
  exit;
}

// Logged in
echo '<h3>Page ID</h3>';
var_dump($helper->getPageId());

echo '<h3>User is admin of page</h3>';
var_dump($helper->isAdmin());

echo '<h3>Signed Request</h3>';
var_dump($helper->getSignedRequest());

echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());