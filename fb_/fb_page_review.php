<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
//echo $_SESSION['user_id'];

$sql1="SELECT * FROM fb_setting WHERE user_id=" . $_SESSION['user_id'];
$result1=$conn->query($sql1);
$fb=$result1->fetch_assoc();
//print_r($fb);die("here");	  

	
		  
$url=$fb['fb_link'];
$app_id=$fb['fb_app_id'];
$fb_app_secret=$fb['fb_app_secret'];
$fb_page_id=$fb['fb_page_id'];
$id=$fb['id'];
 $access_token=$fb['access_token'];
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$fb = new \Facebook\Facebook([
  'app_id' =>$app_id,
  'app_secret' => $fb_app_secret,
  'default_graph_version' => 'v3.0',
  //'default_access_token' => '{access-token}', // optional
]);



try {
	//// code by heena ////
	 $oAuth2Client = $fb->getOAuth2Client();
	 //print_r( $oAuth2Client->debugToken($access_token));echo  $oAuth2Client;die("token");
	
	$tokenMetadata = $oAuth2Client->debugToken($access_token);
	
	$tokenMetadata->validateAppId($app_id);
	//echo $ff;die();
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
 $tokenMetadata->validateExpiration();
	$Long_accessToken = $oAuth2Client->getLongLivedAccessToken($access_token);
 


 $_SESSION['fb_access_token'] = (string) $access_token;

 $access_token=(string) $access_token;
$token_long_lived =(string) $Long_accessToken->getValue();
 
 $token_created_date =(string) $tokenMetadata->getIssuedAt()->date ;
$fb_user_id=$tokenMetadata->getUserId();
 
 	


 $sql1="UPDATE fb_setting SET access_token='" . $token_long_lived . "',fb_user_id='" . $fb_user_id . "',token_created_date ='" . $token_created_date . "',token_long_lived ='" . $access_token  . "' WHERE id=" . $id;
$conn->query($sql1);
//$conn->close(); 
// $redirect = 'http://review-thunder.com/profile.php?id='.$user_id;
  //header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  // Returns a `FacebookFacebookResponse` object 
  //// code by heena ////
  $response_a = $fb->get(
    '/'.$fb_page_id.'?fields=access_token',
    $access_token
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$res = json_decode($response_a->getBody());


$page_accesstoken=$res->access_token;

//echo $page_accesstoken;die("here");

try {
// Returns a `FacebookFacebookResponse` object
$page_res = $fb->get(
$fb_page_id,$page_accesstoken
);

} catch(FacebookExceptionsFacebookResponseException $e) {
echo 'Graph returned an error: ' . $e->getMessage();
exit;

} 
//$graphNode = $response->getAccessToken();
$page_detail=json_decode($page_res->getBody());

$page_id=$page_detail->id;
$page_name=$page_detail->name;
///{page-id}?fields=access_token
try {
  // Returns a `FacebookFacebookResponse` object
 $url_post='/'.$fb_page_id.'/ratings';
  $response1 = $fb->get(
    $url_post,$page_accesstoken
  );
  $url_post_id='/'.$fb_page_id.'/ratings?fields=open_graph_story';
  $response2 = $fb->get(
    $url_post_id,$page_accesstoken
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$getBody = $response1->getDecodedBody();
$getBody_ids = $response2->getDecodedBody();
/*  echo "<pre>";
print_R($getBody);
echo "</pre>"; */
$rating = 0;
$review_rate=array();
if (count($getBody['data']) > 0) {
    foreach ($getBody['data'] as $key=>$review) {
		$getBody['data'][$key]['id']=$getBody_ids['data'][$key]['open_graph_story']['id'];
		/* $url_post_user='/'.$review['reviewer']['id'].'/picture';
  $response_pic = $fb->get(
    $url_post_user,$page_accesstoken
  );
  $getBody_pic = $response_pic->getGraphNode();
   */
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

 function has_reply($com_id){
	 include('connection.php');
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

try {
  // Returns a `FacebookFacebookResponse` object
  $comp_id=$com_id;
  $res_comp = $fb->get(
    $comp_id.'/comments',
    $page_accesstoken
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
 $res_comp1 = $res_comp->getDecodedBody();	 
	return $res_comp1;
	 
 }
 function fbrev_stars($rating) {
?><span class="wp-stars"><?php
foreach (array(1,2,3,4,5) as $val) {
$score = $rating - $val;
if ($score >= 0) {
?><span class="wp-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="16" height="16" viewBox="0 0 1792 1792"><path d="M1728 647q0 22-26 48l-363 354 86 500q1 7 1 20 0 21-10.5 35.5t-30.5 14.5q-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="#4080ff"></path></svg></span><?php
} else if ($score > -1 && $score < 0) {
?><span class="wp-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="16" height="16" viewBox="0 0 1792 1792"><path d="M1250 957l257-250-356-52-66-10-30-60-159-322v963l59 31 318 168-60-355-12-66zm452-262l-363 354 86 500q5 33-6 51.5t-34 18.5q-17 0-40-12l-449-236-449 236q-23 12-40 12-23 0-34-18.5t-6-51.5l86-500-364-354q-32-32-23-59.5t54-34.5l502-73 225-455q20-41 49-41 28 0 49 41l225 455 502 73q45 7 54 34.5t-24 59.5z" fill="#4080ff"></path></svg></span><?php
} else {
?><span class="wp-star"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="16" height="16" viewBox="0 0 1792 1792"><path d="M1201 1004l306-297-422-62-189-382-189 382-422 62 306 297-73 421 378-199 377 199zm527-357q0 22-26 48l-363 354 86 500q1 7 1 20 0 50-41 50-19 0-40-12l-449-236-449 236q-22 12-40 12-21 0-31.5-14.5t-10.5-35.5q0-6 2-20l86-500-364-354q-25-27-25-48 0-37 56-46l502-73 225-455q19-41 49-41t49 41l225 455 502 73q56 9 56 46z" fill="#ccc"></path></svg></span><?php
}
}
?></span><?php
}
 ?>
<!--iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTest-178585066172367%2F&tabs&width=700&height=130&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=2018783381482381" width="700" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe-->

<div class="fb-iframe new_border_style"> 

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

<div class="full-loop new_border_style">
<?php  foreach($getBody['data']  as $reviews){ 

try {
  // Returns a `FacebookFacebookResponse` object
  $comp_id=$reviews['id'];
  $res_comp = $fb->get(
    $comp_id.'/comments',
    $page_accesstoken
  );
} catch(FacebookExceptionsFacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$res_comp1 = $res_comp->getDecodedBody();
/* echo "<pre>";
print_r($res_comp1['data']);
echo "</pre>"; */
  ?>



 <div class="review-data">
  <div class="full-review-row">
  <div class="left-review-icon">
  <img src="https://graph.facebook.com/<?php echo $reviews['reviewer']['id']; ?>/picture" alt="<?php echo $review->reviewer->name; ?>" onerror="/review/fb_/img/avatar.gif">
    
  </div>
  <div class="right-review-data">
    <ul>
      <li class="name-head"><?php  echo $reviews['reviewer']['name'] ;  ?></li>
      <li class="reviewd">reviewed</li>
      <li class="review-li"><?php echo $page_name;  ?>- <span><?php  echo $reviews['rating'] ?><i class="fa fa-star" aria-hidden="true"></i></span></li>
    </ul>
    <p><?php  echo $reviews['created_time'] ?></p>
	<span class="wp-facebook-stars"><?php fbrev_stars($reviews['rating']); ?></span>
  </div> 
</div>
<h3><?php  echo $reviews['review_text'] ?> </h3>

<!-- <div class="thumb-row">
  <p><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span><?php echo $page_name;  ?></p>
</div> -->
<div class="review-text-comment">
  <p><a href="javascript:void(0)" onclick="comts_toggle('<?php echo $comp_id;  ?>');"><?php  echo count($res_comp1['data']);  ?> Comments</a></p>
</div>
<!--div class="coment-row">
	<ul>
	<!--li><a href="#"><span><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> Like</a></li>	
	<li><a href="javascript:void(0)" onclick="comts_toggle('<?php echo $comp_id;  ?>');"><span><i class="fa fa-comment" aria-hidden="true"></i></span> Comment</a></li>	
	</ul>
</div-->
<div class="comment-div" style="display:none"  id="comment-div_<?php echo $comp_id;  ?>">
<?php 
/* echo "<pre>";
print_r($res_comp1['data']);
echo "</pre>"; */
foreach($res_comp1['data'] as $coments ){  ?>
	<ul class="coment-profile">
		<li><img src="https://graph.facebook.com/<?php echo $coments['from']['id']; ?>/picture" alt="<?php echo $review->reviewer->name; ?>" onerror="/review/fb_/img/avatar.gif"></li>
		<li class="comment-friend-bg"><span><?php echo $coments['from']['name'];  ?></span><p class="friend-comment"><?php  echo $coments['message'];   ?></p></li>
	</ul>
	<div class="comment-deatil">
		<ul>
		 
		  <li class="anchor"><a href="javascript:void(0);" onclick="comts_toggle_reply('<?php echo $coments['id'];  ?>');">Reply</a></li>
		  
		</ul>
		<?php   $coms= has_reply($coments['id']); ?>
		<?php if(!empty($coms['data']) ){   ?><div class="review_count">  <a href="javascript:void(0);" onclick="comts_toggle_reply_divs('<?php echo $coments['id'];  ?>');"><?php  echo count($coms['data']); ?> Replies</a> </div><?php }   ?>
		<div class="review_rely_div" style="display:none;" id="div_reply_show_<?php echo $coments['id'];  ?>"><?php $coms= has_reply($coments['id']);
		//print_r($coms);
     if(!empty($coms['data']) ){  
	 foreach($coms['data'] as $c){ ?>
	 <div class="replied_view">
		 <ul class="coment-profile_reply">
		<li><img src="https://graph.facebook.com/<?php echo $c['from']['id']; ?>/picture" alt="<?php echo $review->reviewer->name; ?>" onerror="/review/fb_/img/avatar.gif"></li>
		<li class="comment-friend-bg"><span><?php echo $c['from']['name'];  ?></span><p class="friend-comment"><?php  echo $c['message'];   ?></p></li>
	</ul>
	</div>
	 <?php  }  }
		?>
		</div>
		<ul class="comment-box" style="display:none" id="reply_comment_<?php echo $coments['id']; ?>">
		
		
		
			<li><img src="https://graph.facebook.com/<?php echo $page_id; ?>/picture" alt="<?php echo $page_name; ?>"></li>
			<li class="input-area">
			 <input class="reply_input"  type="text"  name="comments" placeholder="Write your reply" id="rev_id_<?php echo $coments['id']  ?>"     />
     <input type="button" class="btn btn-primary reply_button" value="Send"  onclick="reply_post_comment('<?php echo $coments['id']; ?>');" /></li>
			
			
		</ul>
	</div><?php }	?>
  <div class="full-coment-box">
    <ul>
      <li><img src="https://graph.facebook.com/<?php echo $page_id; ?>/picture" alt="<?php echo $page_name; ?>"></li>
      <li class="full-input-area">
	  <input  type="text" class="reply_input"   name="comments" placeholder="Write your Comment" id="rev_id_<?php echo $comp_id  ?>"     />
     <input type="button" class="btn btn-primary reply_button" value="Send"  onclick="reply_post_comment('<?php echo  $comp_id ; ?>');" />
	</li>
    </ul>
  </div>
  

</div>
 </div>
<?php }  ?>
</div>


<style>
.replied_view li.comment-friend-bg {
  margin-left: 0;
}
.comment-deatil ul:first-child {
  margin-bottom: 0;
}
.review_count {
  margin-bottom: 5px;
}
.replied_view {
  margin-bottom: 12px;
}
.comment-box .input-area .reply_button {
  background: #385E98;
  border: 1px solid #385E98;
  height: 35px;
  position: absolute;
  right: 0px;
  width: 76px !important;
}
.comment-box .input-area {
  position: relative;
}
.full-coment-box {
  position: relative;
}
.full-coment-box input.reply_button {
  background: #385E98;
  border: 1px solid #385E98;
  height: 35px;
  position: absolute;
  right: 15px;
  width: 76px !important;
  top:0 !important;
}
.comment-div{
	margin: 0 -15px;
	border-top: 1px solid #ddd;
	padding-top: 10px;
}
.edit:before {
  display: none;
}
.coment-row ul {
  display: flex;
  list-style: outside none none;
}
.comment-deatil li{
 font-size: 12px;	
}
.comment-deatil li a {
  font-size: 12px;
  color: #4267B2;
}
.input-area {
  padding-right: 0 !important;
  width: 88% !important;
}
.input-area input {
  width: 100% !important;
  border: 1px solid #ddd;
  padding: 5px 15px;
  border-radius: 50px;
  background: #f9f6f6;
}
.comment-deatil li img {
  border-radius: 50%;
  height: 25px;
  width: 25px;
  margin-top: 5px;
}
.full-coment-box ul {
  list-style: outside none none;
  padding-left: 15px;
  display: flex;
}
.full-coment-box li:first-child {
  padding-right: 10px;
}
.full-input-area {
  width: 88%;
}
.review-text-comment p {
  margin-bottom: 5px;
}
.full-input-area input{
    background: #f9f6f6 none repeat scroll 0 0;
    border: 1px solid #dddddd;
    border-radius: 50px;
    padding: 5px 15px;
    width: 100% !important;
    font-size: 13px;
}
.review-text-comment {
  text-align: right;
}
.full-coment-box li img{
 width: 35px;
 height: 35px;
 border-radius: 50%;
}
.comment-deatil li:before{
display: none;
}
.comment-deatil li.edit a {
  color: #616771;
}
.coment-profile {
  display: flex;
  list-style: none;
  padding-left: 15px;
  margin-bottom: 0;
}
.coment-profile span {
  display: inline-block;
  font-weight: bold;
  color: #4267B2;
}
.comment-deatil {
  padding-left: 70px;
}
.comment-deatil li {
  padding-right: 15px;
  position: relative;
}
.comment-deatil li::before {
  content: ".";
  font-size: 12px;
  position: absolute;
  right: 5px;
}
.comment-deatil ul{
display: flex;
list-style: none;
padding-left: 0;
}
.friend-comment {
  display: inline-block;
  padding-left: 10px;
  margin-bottom: 0;
}
.coment-profile li img{
	width: 30px;
	height: 30px;
	border-radius: 50%;
}
.coment-row ul li{
margin-right: 60px;
}
.coment-row ul li a {
  font-size: 17px;
  padding-top: 10px;
  display: inline-block;
  color: #454545;
}
.coment-row{
	border-top: 1px solid #ddd;
}
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
.star-rate span {
  background: #5890ff none repeat scroll 0 0;
  border-radius: 50px;
  color: #ffffff;
  display: flex;
  height: 38px;
  padding: 2px 25px;
}
.star-rate span p {
  font-size: 18px;
  font-weight: bold;
  margin: 0;
}
.cu-left-inner:nth-child(1) {
  float: left;
  width: 15% !important;
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
  width: 50px;
}
.comment-friend-bg {
  background: #f2f2f2;
  margin-left: 15px;
  padding: 5px 15px;
  border-radius: 50px;
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
.left-review-icon img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
.right-review-data p {
    color: #747474;
    font-size: 15px;
    margin-bottom: 3px;
}
.review-data h3 {
    font-weight: 700;
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
  padding: 0px;
  position: relative;
  text-align: center;
  top: -2px;
  width: 22px;
}
.thumb-row p{
  color: #454545;
}
@media (max-width: 1199px) {

.fb-iframe {
  float: left !important;
  width: 30% !important;
}
.full-loop {
  float: left;
  padding-left: 20px;
  width: 70%;
}
#facebookPage11 {
  width: 100%;
}
.cu-left .cu-left-inner:nth-child(1) {
  width: 25% !important;
}
.cu-left .cu-left-inner:nth-child(2) {
  float: left;
  width: 60% !important;
}
}
@media (max-width: 767px) {
.fb-iframe {
  float: left !important;
  width: 100% !important;
}
.fb-iframe .rating-review {
  width: 100%;
}
.cu-left .cu-left-inner:nth-child(1) {
  width: 15% !important;
}
.cu-left .cu-left-inner:nth-child(2) {
  float: left;
  width: 70% !important;
}
.cu-left .cu-left-inner:nth-child(3) {
  text-align: center;
  width: 10%;
}
.full-loop {
  float: left;
  padding-left: 0;
  width: 100%;
}
}
@media (max-width: 480px) {
.right-review-data ul {
  padding-left: 0;
}
.reviewd {
  color: #454545;
  padding-left: 0;
  padding-right: 10px;
}
.cu-left .cu-left-inner:nth-child(1) {
  width: 20% !important;
}
.cu-left .cu-left-inner:nth-child(2) {
  float: left;
  width: 65% !important;
}
}
</style>

