<?php
require_once '../vendor/autoload.php';
require_once '../connection.php';
ini_set('display_errors', 1);

session_start();
$user_id = $_SESSION['user_id'];

$fb = new Facebook\Facebook([
    'app_id' => '1076434519175273', // Replace {app-id} with your app id
    'app_secret' => 'de9101ea7844abe2e6e42059c583539e',
    'default_graph_version' => 'v5.0',
]);


$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error

    echo "    <script>
           window.close();
        </script>";    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues

    echo "    <script>
           window.close();
        </script>";    exit;
}
//if (! isset($accessToken)) {
//if ($helper->getError()) {
//header('HTTP/1.0 401 Unauthorized');
//echo "Error: " . $helper->getError() . "\n";
//echo "Error Code: " . $helper->getErrorCode() . "\n";
//echo "Error Reason: " . $helper->getErrorReason() . "\n";
//echo "Error Description: " . $helper->getErrorDescription() . "\n";
//} else {
//header('HTTP/1.0 400 Bad Request');
//echo 'Bad request';
//}
//exit;
//}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());
$accessTokenValue = $accessToken->getValue();
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
$responseArray = (array) $tokenMetadata;
$token_metadata = $responseArray[array_keys($responseArray)[0]];
//var_dump();
$page_id  = $token_metadata['granular_scopes'][0]['target_ids'][0];
$sql = "update fb_setting set access_token = '$accessTokenValue', fb_page_id = '$page_id' where user_id = '$user_id' ";
$conn->query($sql);
// Validation (these will throw FacebookSDKException's when they fail)
//$tokenMetadata->validateAppId('{app-id}'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
//$tokenMetadata->validateExpiration();

//if (! $accessToken->isLongLived()) {
// Exchanges a short-lived access token for a long-lived one
//try {
//$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
//} catch (Facebook\Exceptions\FacebookSDKException $e) {
//echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
//exit;
//}/
//upda
//echo '<h3>Long-lived</h3>';
//var_dump($accessToken->getValue());
//}

$_SESSION['fb_access_token'] = (string) $accessToken;

echo "    <script>
           window.close();
        </script>";
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
