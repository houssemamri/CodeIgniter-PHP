<?php
require_once ('../Facebook/autoload.php');
function getFbToken($appID, $appSecret){
    $tokenfileName = 'access_token.dat';
    $accessToken = FALSE;
    $logfile = 'log/error-log_'.date('d-m-Y');
    $fb = new Facebook\Facebook([
      'app_id' => $appID,
      'app_secret' => $appSecret, 
      'default_graph_version' => 'v2.6',
      ]);

    $tokenfileName = $_SESSION['UID'].'_'.$tokenfileName;
    $tokenFilePath = 'tokens/'.$tokenfileName;
    if(file_exists($tokenFilePath)){
        $accessToken = unserialize(file_get_contents($tokenFilePath));
		
    }
    if(!$accessToken || $accessToken->isExpired()){
        $facebookClient = $fb->getClient();

        $jsHelper = $fb->getJavaScriptHelper();
        try {
            $accessToken = $jsHelper->getAccessToken($facebookClient);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            $fh = fopen($logfile, 'a');
            fwrite($fh, date('d-m-Y H:i:s').' - Graph returned an error: ' . $e->getMessage() . "\n");
            fclose($fh);
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            $fh = fopen($logfile, 'a');
            fwrite($fh, date('d-m-Y H:i:s').' - Facebook SDK returned an error: ' . $e->getMessage() ."\n");
            fclose($fh);
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }
        if (isset($accessToken)) {
                $oAuth2Client = $fb->getOAuth2Client();
                $tokenMetadata = $oAuth2Client->debugToken($accessToken);
                if (! $accessToken->isLongLived()) {
              try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
              } catch (Facebook\Exceptions\FacebookSDKException $e) {
                    $fh = fopen($logfile, 'a');
                    fwrite($fh, date('d-m-Y H:i:s').' - Error getting long-lived access token: ' . $helper->getMessage() . "\n");
                    fclose($fh);
                    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                    exit;
              }
             $newTokenfile = fopen($tokenFilePath, 'w');
             fwrite($newTokenfile, serialize($accessToken));
             fclose($newTokenfile);
            }
            return $accessToken->getValue();
        }
        else{
            $fh = fopen($logfile, 'a');
            fwrite($fh, date('d-m-Y H:i:s')." - Unable to read JavaScript SDK cookie");
            fclose($fh);
            return False;
        }
    }
    else{
        return $accessToken->getValue();

    }

}
