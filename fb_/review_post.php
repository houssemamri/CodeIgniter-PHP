
<?php

include('../connection.php');
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
session_start();
$sql1="SELECT * FROM fb_setting WHERE user_id=" . $_SESSION['user_id'];
$result1=$conn->query($sql1);
$fb=$result1->fetch_assoc();	  
				  
$url=$fb['fb_link'];
$app_id=$fb['fb_app_id'];
$fb_app_secret=$fb['fb_app_secret'];
$fb_page_id=$fb['fb_page_id'];
$access_token=$fb['access_token'];

/* 				  
$url='https://www.facebook.com/Test-178585066172367/?modal=admin_todo_tour';
$app_id='2018783381482381';
$fb_app_secret='2398702e763124d4f9dbc5fb52c0933f';
$fb_page_id='178585066172367';
$access_token='EAAcsEqJU640BANrsV3zza13JqRtTB5P9lzevpwzVyIXO71u2S8aqAp7QQmVtvUMXApv37VIWPxFw71WNBRASV4hZBst1WPpCU7R060xpmiLO6rfEwuezMSZCw0buHlKOLOFKHNZCGAYoYF7z0XVhDtZCIUn1iDZBrAb0A4rc3ybQThtPUra6v';
 */
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://graph.facebook.com/".$fb_page_id."?fields=access_token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$access_token,
    "Cache-Control: no-cache",
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $res= "cURL Error #:" . $err;
} else {
 $res= json_decode($response);
}

 $page_accesstoken=$res->access_token;


$curl = curl_init();
$url="https://graph.facebook.com/v2.9/".$_POST['id']."/comments?message=".$_POST['text']."&access_token=".$page_accesstoken;
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "Cache-Control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
  die;
}
