

<?php  
include('../review/connection.php');
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
			$sql1="SELECT * FROM fb_setting WHERE user_id=" . $_SESSION['user_id'];
$result1=$conn->query($sql1);

$fb=$result1->fetch_assoc();	  
				  
$url=$fb['fb_link'];
$app_id=$fb['fb_app_id'];
$fb_app_secret=$fb['fb_app_secret'];
$fb_page_id=$fb['fb_page_id'];
$access_token=$fb['access_token'];

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

require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' =>$app_id,
  'app_secret' => $fb_app_secret,
  'default_graph_version' => 'v3.0',
  //'default_access_token' => '{access-token}', // optional
]);
///{page-id}?fields=access_token
try {
  // Returns a `FacebookFacebookResponse` object
 $url_post='/'.$fb_page_id.'/ratings';
  $response1 = $fb->get(
    $url_post,$page_accesstoken
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

 $url_post_photo='/'.$fb_page_id.'/photos';
  $res_photo = $fb->get(
    $url_post_photo,$page_accesstoken
  );
$getBody = $response1->getDecodedBody();
 echo "<pre>";
print_R($res_photo); 
$rating = 0;
if (count($getBody['data']) > 0) {
    foreach ($getBody['data'] as $review) {
        $rating = $rating + $review['rating'];
    }
    $rating = round($rating / count($getBody['data']), 1);
    $rating = number_format((float)$rating, 1, '.', '');
}
 $rating;
?>

<div class="fb-iframe"> 

<iframe src="https://www.facebook.com/plugins/page.php?href=<?php  echo $url; ?>&tabs=timeline&width=1200&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=<?php  echo $app_id; ?>" width="1200" height="800" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
</div>

<div class="full-loop">
<?php  foreach($getBody['data']  as $reviews){  ?>

 <div class="review-data">
  <div class="full-review-row">
  <div class="left-review-icon">
    <img src="/review/fb_/img/avatar.gif" alt="">
  </div>
  <div class="right-review-data">
    <ul>
      <li class="name-head">Test</li>
      <li class="reviewd">reviewed</li>
      <li class="review-li">test- <span><?php  echo $reviews['rating'] ?><i class="fa fa-star" aria-hidden="true"></i></span></li>
    </ul>
    <p><?php  echo $reviews['created_time'] ?></p>
  </div> 
</div>
<h3><?php  echo $reviews['review_text'] ?> </h3>
<div class="thumb-row">
  <p><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>Page Name</p>
</div>
 </div>
<?php }  ?>
</div>



<style>
.fb-iframe {
    width: 50% !important;
    float: left !important;
}
.fb-iframe iframe {
    width: 100%;
}
.full-loop {
    float: left;
    width: 50%;
    padding-left: 20px;
}
.review-data {
  background: #ffffff none repeat scroll 0 0;
  border: 1px solid #dddddd;
  padding: 15px;
  margin-bottom: 20px;
}
.full-review-row {
  display: flex;
  width: 100%;
}
.right-review-data {
  width: 80%;
  padding-top: 8px;
  padding-left:15px;
}
.left-review-icon {
  width: 80px;
}
.right-review-data ul {
  display: flex;
  line-height: 20px;
  list-style: outside none none;
  margin-bottom: 0;
  padding-left: 0;
}
.name-head {
  font-size: 20px;
  font-weight: 600;
  color: #4267B2;
}
.reviewd {
  color: #454545;
  padding-left: 8px;
  padding-right: 10px;
}
.review-li {
  color: #4267B2;
}
.review-li span {
  background: #4267b2 none repeat scroll 0 0;
  border-radius: 12px;
  color: #ffffff;
  font-size: 13px;
  padding: 2px 8px 3px 8px;
}
.review-li span i {
    font-size: 8px;
    position: relative;
    right: -1px;
    top: -3px;
}
.right-review-data p {
    color: #747474;
    font-size: 15px;
}
.review-data h3 {
  font-weight: 400;
  font-size: 22px;
  color: #3b3b3b;
}
.thumb-row p span {
  background: #4267b2 none repeat scroll 0 0;
  border-radius: 50%;
  color: #ffffff;
  display: inline-block;
  font-size: 12px;
  height: 22px;
  margin-right: 5px;
  padding: 1px;
  position: relative;
  text-align: center;
  top: -2px;
  width: 22px;
}
.thumb-row p{
  color: #454545;
}
</style>

