

<?php
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
$getBody = $response1->getDecodedBody();
/* echo "<pre>";
print_R($getBody); */
$rating = 0;
$review_rate=array();
if (count($getBody['data']) > 0) {
    foreach ($getBody['data'] as $review) {
        $rating = $rating + $review['rating'];
		if($review['rating']=="5"){
$review_rate[5][]=$review['rating'];

}else if($review['rating']=="4"){

$review_rate[4][]=$review['rating'];
}else if($review['rating'] ==3){			
$review_rate[3][]=$review['rating'];


}else if($review['rating']=="2"){
$review_rate[2][]=$review['rating'];

}else{

$review_rate[1][]=$review['rating'];
}
}

    $rating = round($rating / count($getBody['data']), 1);
    $rating = number_format((float)$rating, 1, '.', '');
}
 $rating;
?>
<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTest-178585066172367%2F&tabs&width=700&height=130&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=2018783381482381" width="700" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
<div class="fb-iframe"> 

         <div class="rating-review">
		
            <div class="star-rate">
               <span>
                  <p><?php echo $rating; ?></p>
                  <i class="fa fa-star" aria-hidden="true"></i>
               </span>
               <div class="rate-text">
                  <p><?php echo $rating; ?> out of 5 Stars</p>
                  <p><?php echo  count($getBody['data']);  ?> reviews</p>
               </div>
            </div>
            <div class="star-progressbar">
             
                  <div class="cu-left">
                     <div class="cu-left-inner" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">5 Star<span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <?php  if(isset($review_rate[5])){
                        $per = array_sum($review_rate[5]);
                        $total = 5;
                        
                        $new_width = ($per / $total) * 100;
                        $class="bar-sustom";
                        }else{
                        $new_width="0";
                        $class="";
                        }
                        ?>
                     <div class="cu-left-inner" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="<?php echo $class;   ?>" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $new_width  ?>%">
                           </div>
                        </div>
                     </div>
                     <div class="cu-left-inner" style="margin-left:10px;"><?php if(isset($review_rate[5])){ echo count($review_rate[5]) ; }else{ echo "0";  } ?></div>
                  </div>
                  <div class="cu-left">
                     <?php  if(isset($review_rate[4])){
                        $per1 = array_sum($review_rate[4]);
                        $total1 = 4;
                        
                        $new_width1 = ($per1 / $total1) * 100;
                        $class="bar-sustom";
                        }else{
                        $new_width1="0";
                        $class="";
                        }
                        ?>
                     <div class="cu-left-inner" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">4 Star<span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <div class="cu-left-inner" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="<?php echo $class;   ?>"  role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $new_width1  ?>%">
                           </div>
                        </div>
                     </div>
                     <div class="cu-left-inner" style="margin-left:10px;"><?php if(isset($review_rate[4])){ echo count($review_rate[4]) ; }else{ echo "0";  } ?></div>
                  </div>
                  <div class="cu-left">
                     <?php  if(isset($review_rate[3])){
                        $per2 = array_sum($review_rate[3]);
                        $total2 = 3;
                        
                        $new_width2 = ($per2 / $total2) * 100;
                        $class="bar-sustom";
                        }else{
                        $new_width2="0";
                        $class="";
                        }
                        ?>
                     <div class="cu-left-inner" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">3 Star<span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <div class="cu-left-inner" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="<?php echo $class;   ?>"  role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $new_width2  ?>%">
                           </div>
                        </div>
                     </div>
                     <div class="cu-left-inner" style="margin-left:10px;"><?php if(isset($review_rate[3])){ echo count($review_rate[3]) ; }else{ echo "0";  } ?></div>
                  </div>
                  <div class="cu-left">
                     <?php  if(isset($review_rate[2])){
                        $per3 = array_sum($review_rate[2]);
                        $total3 = 2;
                        
                        $new_width3 = ($per3 / $total3) * 100;
                        $class="bar-sustom";
                        }else{
                        $new_width3="0";
                        $class="";
                        }
                        ?>
                     <div class="cu-left-inner" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">2 Star<span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <div class="cu-left-inner" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="<?php echo $class;   ?>"  role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $new_width3  ?>%">
                           </div>
                        </div>
                     </div>
                     <div class="cu-left-inner" style="margin-left:10px;"><?php if(isset($review_rate[2])){ echo count($review_rate[2]) ; }else{ echo "0";  } ?></div>
                  </div>
                  <div class="cu-left">
                     <?php  if(isset($review_rate[1])){
                        $per4 = array_sum($review_rate[1]);
                        $total4 = 1;
                        $class="bar-sustom";
                        
                        $new_width4 = ($per4 / $total4) * 100;
                        }else{
                        $new_width4="0";
                        $class="";
                        }
                        ?>
                     <div class="cu-left-inner" style="width:35px; line-height:1;">
                        <div style="height:9px; margin:5px 0;">1 Star <span class="glyphicon glyphicon-star"></span></div>
                     </div>
                     <div class="cu-left-inner" style="width:180px;">
                        <div class="progress" style="height:9px; margin:8px 0;">
                           <div class="<?php echo $class;   ?>"  role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: <?php echo $new_width4  ?>%">
                           </div>
                        </div>
                     </div>
                     <div class="cu-left-inner" style="margin-left:10px;"><?php if(isset($review_rate[1])){ echo count($review_rate[1]) ; }else{ echo "0";  } ?></div>
                  </div>
               
            </div>
         </div>
       

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
.cu-left{
float: left;	
width:100%;
}
.cu-left-inner{
float: left;
color:#848484;
}
.cu-left-inner:nth-child(1) {
	float: left;
	width: 5% !important;
}
.bar-sustom{
background: #4080ff;
height	: 8PX;
border-radius: 7px;

}
.rating-review {
background: #ffffff none repeat scroll 0 0;
border: 1px solid #dddddd !important;
border-radius: 5px;
padding: 20px;
display:inline-block;
}
.star-rate {
border-bottom: 1px solid #dddddd;
display: flex;
padding-bottom: 30px;
}
.star-rate span {
background: #5890ff none repeat scroll 0 0;
border-radius: 50px;
color: #ffffff;
display: flex;
height: 25px;
padding: 8px 25px;
}
.star-rate span p {
font-size: 20px;
font-weight: bold;
margin:0;
}
.star-rate i {
margin-top: 7px;
}
.rate-text p {
font-size: 14px;
line-height: 16px;
margin-bottom: 0;
margin-top:0;
}
.rate-text {
margin-left: 10px;
}
.progress-bar {
background-color: #5890ff;
color: #ffffff;
display: flex;
flex-direction: column;
justify-content: center;
text-align: center;
transition: width 0.6s ease 0s;
}
.star-progressbar li {
display: inline-block;
width: 100%;
}
.star-progressbar ul {
display: inline-block;
padding: 30px 0 0;
width: 100%;
margin-bottom: 0;
}
.star-progressbar li p {
float: left;
margin-bottom: 0;
width: 15%;
}
.star-progressbar li .progress {
float: left;
margin-left: 15px;
margin-top: 5px;
width: 75%;
}
.star-progressbar li span {
float: right;
}
</style>

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

