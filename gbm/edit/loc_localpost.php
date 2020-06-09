<?php

ini_set('display_errors', 1); 
include_once "../../connection.php";
include_once "../../common_function.php";

include_once realpath(dirname(__FILE__) ."/../examples/templates/base.php");
//require_once realpath(dirname(__FILE__) . '/../autoload.php');
require_once realpath(dirname(__FILE__) . '/../vendor/autoload.php');

include_once realpath(dirname(__FILE__) ."/../MyBusiness.php");
 
session_start();

    $sql="SELECT * FROM oauth_user WHERE user_id=1";
	$result=$conn->query($sql);
    $data=$result->fetch_array();

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
$client_id = $data['client_id'];
$client_secret = $data['client_secret'];
$redirect_uri = base_url2().'gbm/examples/idtoken.php';

$client = new Google_Client();
$client->setRedirectUri($redirect_uri);
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('https://www.googleapis.com/auth/plus.business.manage');
$client->setApprovalPrompt('force');
$client->setAccessType('offline'); 
$client->setAccessToken($data['access_token']);

$service = new Google_Service_Mybusiness($client);
//----------------- Update Location -----------------------

$updateLocation =  $service->accounts_locations_localPosts;
$localPost = new Google_Service_MyBusiness_LocalPost($client);
$event = new Google_Service_MyBusiness_LocalPostEvent($client);
$schedule = new Google_Service_MyBusiness_TimeInterval($client);
$endDate = new Google_Service_MyBusiness_Date($client);
$startDate = new Google_Service_MyBusiness_Date($client);
$endTime = new Google_Service_MyBusiness_TimeOfDay($client);
$startTime = new Google_Service_MyBusiness_TimeOfDay($client);
$callToAction = new Google_Service_MyBusiness_CallToAction($client);
$offerType = new Google_Service_MyBusiness_LocalPostOffer($client);
$media = new Google_Service_MyBusiness_MediaItem($client);
$name=$_POST['loc_name'];
$localPost->setLanguageCode('en-US');
$localPost->setSummary($_POST['post_detail']);

if($_POST['TopicType']=="STANDARD"){
$callToAction->setActionType($_POST['callToAction']);	
$url =$_POST['post_url'] ;
$callToAction->setUrl($url);
$localPost->setCallToAction($callToAction);

}
if($_POST['TopicType']=="EVENT"){
	$callToAction->setActionType($_POST['callToAction']);
	$event->setTitle($_POST['event_title']);
$url =$_POST['post_url'] ;
$callToAction->setUrl($url);
$localPost->setCallToAction($callToAction);
	

$start_date=strtotime($_POST['start_date']);
$end_date=strtotime($_POST['end_date']);
$start_time=strtotime($_POST['start_time']);
$end_time=strtotime($_POST['end_time']);

 $s_month=date("m",$start_date);
 $s_year=date("Y",$start_date);
 $s_day=date("d",$start_date);
 $e_month=date("m",$end_date);
 $e_year=date("Y",$end_date);
 $e_day=date("d",$end_date);



 $s_h=date("h",$start_time);
 $s_i=date("i",$start_time);
 $s_s=date("s",$start_time);
 
  $e_h=date("h",$end_time);
  $e_i=date("i",$end_time);
  $e_s=date("s",$end_time);
 


	
$endDate->setYear($e_year);
$endDate->setMonth($e_month);
$endDate->setDay($e_day);
 $endTime->setHours($e_h);
$endTime->setMinutes($e_i);
$endTime->setNanos('0');
$endTime->setSeconds($e_s); 
$startDate->setDay($s_day);
$startDate->setMonth($s_month);
$startDate->setYear($s_year);
 $startTime->setHours($s_h);
$startTime->setMinutes($s_i);
$startTime->setNanos('0');
$startTime->setSeconds($s_s); 

$schedule->setEndDate($endDate);
$schedule->setEndTime($endTime);
$schedule->setStartDate($startDate);
$schedule->setStartTime($startTime);

$event->setSchedule($schedule);
$localPost->setEvent($event);


}

 if($_POST['TopicType']=="OFFER"){

	
	
$event->setTitle($_POST['event_title']);

	
	
$start_date=strtotime($_POST['start_date']);
$end_date=strtotime($_POST['end_date']);
$start_time=strtotime($_POST['start_time']);
$end_time=strtotime($_POST['end_time']);

 $s_month=date("m",$start_date);
 $s_year=date("Y",$start_date);
 $s_day=date("d",$start_date);
 $e_month=date("m",$end_date);
 $e_year=date("Y",$end_date);
 $e_day=date("d",$end_date);



 $s_h=date("h",$start_time);
 $s_i=date("i",$start_time);
 $s_s=date("s",$start_time);
 
  $e_h=date("h",$end_time);
  $e_i=date("i",$end_time);
  $e_s=date("s",$end_time);
 


	
$endDate->setYear($e_year);
$endDate->setMonth($e_month);
$endDate->setDay($e_day);
 $endTime->setHours($e_h);
$endTime->setMinutes($e_i);
$endTime->setNanos('0');
$endTime->setSeconds($e_s); 
$startDate->setDay($s_day);
$startDate->setMonth($s_month);
$startDate->setYear($s_year);
 $startTime->setHours($s_h);
$startTime->setMinutes($s_i);
$startTime->setNanos('0');
$startTime->setSeconds($s_s); 

$schedule->setEndDate($endDate);
$schedule->setEndTime($endTime);
$schedule->setStartDate($startDate);
$schedule->setStartTime($startTime);

$event->setSchedule($schedule);
$offerType->setCouponCode($_POST['couponCode']);
$offerType->setRedeemOnlineUrl($_POST['redeemOnlineUrl']);
$offerType->setTermsConditions($_POST['termsConditions']);	
$localPost->setEvent($event);
$localPost->setOffer($offerType);
}

 if(!empty($_FILES['post_img']['name'])){
	$target_dir = $_SERVER['DOCUMENT_ROOT'] ."/upload_media/";
$target_file = $target_dir . basename($_FILES["post_img"]["name"]);
$image_info = getimagesize($_FILES["post_img"]["tmp_name"]);
 $image_width = $image_info[0];
 $image_height = $image_info[1];
 if(!move_uploaded_file($_FILES['post_img']['tmp_name'],$target_file )){
		     die('Error uploading file - check destination is writeable.');
    }	
$target_url = $_SERVER['SERVER_NAME'] ."/upload_media/";
$target_urlfile = $target_url . basename($_FILES["post_img"]["name"]);
 $mediaurl = 'http://' . $target_urlfile;

$media->setMediaFormat("PHOTO");
$media->setName($_FILES["post_img"]["name"]);
$media->setSourceUrl($mediaurl);
$media->setThumbnailUrl($mediaurl);
$media->setGoogleUrl($mediaurl);
$localPost->setMedia($media);
}	

//



$localPost->setTopicType($_POST['TopicType']);



$new=$updateLocation->create($name, $localPost); 
$list = $updateLocation->listAccountsLocationsLocalPosts($name);


 ?>
<div class="post-tab-area">
								
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item">
                                        <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="what-new-tab" data-toggle="tab" href="#what-new" role="tab" aria-controls="what-new" aria-selected="false">What's New</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">Events</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="Offers-tab" data-toggle="tab" href="#Offers" role="tab" aria-controls="Offers" aria-selected="false">Offers</a>
                                      </li>
                                      <!--li class="nav-item">
                                        <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="false">Products</a>
                                      </li-->
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
									  <?php foreach($list->getLocalPosts() as $local){
$post_type=$local->getTopicType();
  
$event=$local->getEvent();
$calltoaction=$local->getCallToAction();
$getOffer=$local->getOffer();
$getcreatetime = $local->getCreateTime();
 $media=$local->getMedia();
 $img_url=$media[0]->googleUrl;




if(!empty($event->title)){
$getSchedule=$event->getSchedule();
$date_f=$getSchedule->getStartDate();
$sTime=$getSchedule->getStartTime();
$date_e=$getSchedule->getEndDate();
$end_Time=$getSchedule->getEndTime();
$event_title=$event->title;
// start date
$s_day=$date_f->day;
$s_month=$date_f->month;
$s_year=$date_f->year;
$sTime_h=$sTime->hours;
$sTime_m=$sTime->minutes;
$sTime_s=$sTime->seconds;
$date=date_create($s_year."-".$s_month."-".$s_day);
$start_date= date_format($date,"M d");
if(empty($sTime_m))
{
	$sTime_m2='00'; 
}
else{
	$sTime_m2=$sTime_m;
}
if(empty($sTime_s))
{
	$sTime_s2='00'; 
}
else{
	$sTime_s2=$sTime_s;
}
 $start_time = $sTime_h.":".$sTime_m2.":".$sTime_s2;
 $start_time2=date("g:i A", strtotime($start_time));
	// end date
	$e_day=$date_e->day;
	$e_month=$date_e->month;
	$e_year=$date_e->year;
	$end_Time_h=$end_Time->hours;
	$end_Time_m=$end_Time->minutes;
$end_Time_s=$end_Time->seconds;
	$edate=date_create($e_year."-".$e_month."-".$e_day);
    $end_date= date_format($edate,"M d");
	
	if(empty($end_Time_m))
{
	$end_Time_m2='00'; 
}
else{
	$end_Time_m2=$end_Time_m;
}
if(empty($end_Time_s))
{
	$end_Time_s2='00'; 
}
else{
	$end_Time_s2=$end_Time_s;
}
 $end_time = $end_Time_h.":".$end_Time_m2.":".$end_Time_s2;
 $end_time2=date("g:i A", strtotime($end_time));
$t_date=$start_date.','.$start_time2."-".$end_date.','.$end_time2;	

	
}else{
	$event_title='';
	$start_date='';
	$end_date='';
	$start_time2='';
	$end_time2="";
	$t_date="";
}
								
									  ?>
                                        <div class="all-pos-data">
										
                                            <div class="post-time">
											<?php if(!empty($img_url))
											{?>
											<img src="<?php echo @$img_url;?>" height="200px" width="200px"/>
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											<?php }else{ ?>
											<div class="text_without_img">
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											</div>
											<?php }?>
											
											
											</div>
                                            <h4><?php echo @$event_title;   ?></h4>
											
                                            <div class="post-date-time"><?php echo $t_date;?></div>
                                            <div class="post-photo">
                                                <h6><?php echo  $local->summary ;   ?></h6>
                                              <?php 
											  if(!empty($getOffer)){   ?>										  
							<a href="<?php echo $getOffer->getRedeemOnlineUrl();   ?>" target="_blank">Redeem Online</a>
												<div class="inner-photo-post">
                                                    <p>Show this code at the store</p>
                                                    <h3><?php echo $getOffer->getCouponCode();  ?></h3>
													<?php 
                                              													
													$start_vdate= date_format($date,"m/d/Y");$end_vdate= date_format($edate,"m/d/Y");  ?>
                                                    <p>Valid <?php echo $start_vdate.',';?><?php echo $start_time2.'-'; ?> <?php echo $end_vdate.',' ;?> <?php echo $end_time2;?></p>
                                                </div>
									          <?php }  ?>
												<?php if(!empty($calltoaction)){
$output = str_replace('_', ' ', $calltoaction->getActionType());
												?>
<a href="<?php  echo $calltoaction->getUrl();  ?>"  ><?php echo $output;   ?>
</a>
	<?php } ?>
	<?php if(!empty($getOffer)){   ?>
                                                <div class="post-term">
                                                    <a href="#">Terms and Conditions <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
													<?php echo $getOffer->getTermsConditions(); ?>
                                                </div>
	<?php  }  ?>
                                            </div>
                                            <!--div class="post-view-div">
                                                <ul>
                                                    <li class="not-enough"><a href="#">Not enough data for insights yet</a></li>
                                                    <li class="post-arrow-li"><a href="#">View Post On <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a></li>
                                                    <li class="dot-ellipis"><a href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div--->
                                        </div>
									  <?php } ?>
                                      </div>
                                      <div class="tab-pane fade" id="what-new" role="tabpanel" aria-labelledby="what-new-tab">
									 <?php foreach($list->getLocalPosts() as $local){
 
  $post_type=$local->getTopicType();
  if($post_type=='STANDARD')
  {
$event=$local->getEvent();
$calltoaction=$local->getCallToAction();
$getOffer=$local->getOffer();
$getcreatetime = $local->getCreateTime();
 $media=$local->getMedia();
 $img_url=$media[0]->googleUrl;




if(!empty($event->title)){
$getSchedule=$event->getSchedule();
$date_f=$getSchedule->getStartDate();
$sTime=$getSchedule->getStartTime();
$date_e=$getSchedule->getEndDate();
$end_Time=$getSchedule->getEndTime();
$event_title=$event->title;
// start date
$s_day=$date_f->day;
$s_month=$date_f->month;
$s_year=$date_f->year;
$sTime_h=$sTime->hours;
$sTime_m=$sTime->minutes;
$sTime_s=$sTime->seconds;
$date=date_create($s_year."-".$s_month."-".$s_day);
$start_date= date_format($date,"M d");
if(empty($sTime_m))
{
	$sTime_m2='00'; 
}
else{
	$sTime_m2=$sTime_m;
}
if(empty($sTime_s))
{
	$sTime_s2='00'; 
}
else{
	$sTime_s2=$sTime_s;
}
 $start_time = $sTime_h.":".$sTime_m2.":".$sTime_s2;
 $start_time2=date("g:i A", strtotime($start_time));
	// end date
	$e_day=$date_e->day;
	$e_month=$date_e->month;
	$e_year=$date_e->year;
	$end_Time_h=$end_Time->hours;
	$end_Time_m=$end_Time->minutes;
$end_Time_s=$end_Time->seconds;
	$edate=date_create($e_year."-".$e_month."-".$e_day);
    $end_date= date_format($edate,"M d");
	
	if(empty($end_Time_m))
{
	$end_Time_m2='00'; 
}
else{
	$end_Time_m2=$end_Time_m;
}
if(empty($end_Time_s))
{
	$end_Time_s2='00'; 
}
else{
	$end_Time_s2=$end_Time_s;
}
 $end_time = $end_Time_h.":".$end_Time_m2.":".$end_Time_s2;
 $end_time2=date("g:i A", strtotime($end_time));
$t_date=$start_date.','.$start_time2."-".$end_date.','.$end_time2;	

	
}else{
	$event_title='';
	$start_date='';
	$end_date='';
	$start_time2='';
	$end_time2="";
	$t_date="";
}
								
									  ?>
                                        <div class="all-pos-data">
										
                                            <div class="post-time">
											<?php if(!empty($img_url))
											{?>
											<img src="<?php echo @$img_url;?>" height="200px" width="200px"/>
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											<?php }else{ ?>
											<div class="text_without_img">
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											</div>
											<?php }?>
											
											
											</div>
                                            <h4><?php echo @$event_title;   ?></h4>
											
                                            <div class="post-date-time"><?php echo $t_date;?></div>
                                            <div class="post-photo">
                                                <h6><?php echo  $local->summary ;   ?></h6>
                                              <?php 
											  if(!empty($getOffer)){   ?>										  
							<a href="<?php echo $getOffer->getRedeemOnlineUrl();   ?>" target="_blank">Redeem Online</a>
												<div class="inner-photo-post">
                                                    <p>Show this code at the store</p>
                                                    <h3><?php echo $getOffer->getCouponCode();  ?></h3>
													<?php 
                                              													
													$start_vdate= date_format($date,"m/d/Y");$end_vdate= date_format($edate,"m/d/Y");  ?>
                                                    <p>Valid <?php echo $start_vdate.',';?><?php echo $start_time2.'-'; ?> <?php echo $end_vdate.',' ;?> <?php echo $end_time2;?></p>
                                                </div>
									          <?php }  ?>
												<?php if(!empty($calltoaction)){
$output = str_replace('_', ' ', $calltoaction->getActionType());
												?>
<a href="<?php  echo $calltoaction->getUrl();  ?>"  ><?php echo $output;   ?>
</a>
	<?php } ?>
	<?php if(!empty($getOffer)){   ?>
                                                <div class="post-term">
                                                    <a href="#">Terms and Conditions <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
													<?php echo $getOffer->getTermsConditions(); ?>
                                                </div>
	<?php  }  ?>
                                            </div>
                                            <!--div class="post-view-div">
                                                <ul>
                                                    <li class="not-enough"><a href="#">Not enough data for insights yet</a></li>
                                                    <li class="post-arrow-li"><a href="#">View Post On <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a></li>
                                                    <li class="dot-ellipis"><a href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div--->
                                       
                                        </div>
								<?php } } ?>
									  </div>
                                      
								<div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events-tab">
								<?php foreach($list->getLocalPosts() as $local){
 
  $post_type=$local->getTopicType();
  if($post_type=='EVENT')
  {
$event=$local->getEvent();
$calltoaction=$local->getCallToAction();
$getOffer=$local->getOffer();
$getcreatetime = $local->getCreateTime();
 $media=$local->getMedia();
 $img_url=$media[0]->googleUrl;




if(!empty($event->title)){
$getSchedule=$event->getSchedule();
$date_f=$getSchedule->getStartDate();
$sTime=$getSchedule->getStartTime();
$date_e=$getSchedule->getEndDate();
$end_Time=$getSchedule->getEndTime();
$event_title=$event->title;
// start date
$s_day=$date_f->day;
$s_month=$date_f->month;
$s_year=$date_f->year;
$sTime_h=$sTime->hours;
$sTime_m=$sTime->minutes;
$sTime_s=$sTime->seconds;
$date=date_create($s_year."-".$s_month."-".$s_day);
$start_date= date_format($date,"M d");
if(empty($sTime_m))
{
	$sTime_m2='00'; 
}
else{
	$sTime_m2=$sTime_m;
}
if(empty($sTime_s))
{
	$sTime_s2='00'; 
}
else{
	$sTime_s2=$sTime_s;
}
 $start_time = $sTime_h.":".$sTime_m2.":".$sTime_s2;
 $start_time2=date("g:i A", strtotime($start_time));
	// end date
	$e_day=$date_e->day;
	$e_month=$date_e->month;
	$e_year=$date_e->year;
	$end_Time_h=$end_Time->hours;
	$end_Time_m=$end_Time->minutes;
$end_Time_s=$end_Time->seconds;
	$edate=date_create($e_year."-".$e_month."-".$e_day);
    $end_date= date_format($edate,"M d");
	
	if(empty($end_Time_m))
{
	$end_Time_m2='00'; 
}
else{
	$end_Time_m2=$end_Time_m;
}
if(empty($end_Time_s))
{
	$end_Time_s2='00'; 
}
else{
	$end_Time_s2=$end_Time_s;
}
 $end_time = $end_Time_h.":".$end_Time_m2.":".$end_Time_s2;
 $end_time2=date("g:i A", strtotime($end_time));
$t_date=$start_date.','.$start_time2."-".$end_date.','.$end_time2;	

	
}else{
	$event_title='';
	$start_date='';
	$end_date='';
	$start_time2='';
	$end_time2="";
	$t_date="";
}
								
									  ?>
                                        <div class="all-pos-data">
										
                                            <div class="post-time">
											<?php if(!empty($img_url))
											{?>
											<img src="<?php echo @$img_url;?>" height="200px" width="200px"/>
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											<?php }else{ ?>
											<div class="text_without_img">
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											</div>
											<?php }?>
											
											
											</div>
                                            <h4><?php echo @$event_title;   ?></h4>
											
                                            <div class="post-date-time"><?php echo $t_date;?></div>
                                            <div class="post-photo">
                                                <h6><?php echo  $local->summary ;   ?></h6>
                                              <?php 
											  if(!empty($getOffer)){   ?>										  
							<a href="<?php echo $getOffer->getRedeemOnlineUrl();   ?>" target="_blank">Redeem Online</a>
												<div class="inner-photo-post">
                                                    <p>Show this code at the store</p>
                                                    <h3><?php echo $getOffer->getCouponCode();  ?></h3>
													<?php 
                                              													
													$start_vdate= date_format($date,"m/d/Y");$end_vdate= date_format($edate,"m/d/Y");  ?>
                                                    <p>Valid <?php echo $start_vdate.',';?><?php echo $start_time2.'-'; ?> <?php echo $end_vdate.',' ;?> <?php echo $end_time2;?></p>
                                                </div>
									          <?php }  ?>
												<?php if(!empty($calltoaction)){
$output = str_replace('_', ' ', $calltoaction->getActionType());
												?>
<a href="<?php  echo $calltoaction->getUrl();  ?>"  ><?php echo $output;   ?>
</a>
	<?php } ?>
	<?php if(!empty($getOffer)){   ?>
                                                <div class="post-term">
                                                    <a href="#">Terms and Conditions <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
													<?php echo $getOffer->getTermsConditions(); ?>
                                                </div>
	<?php  }  ?>
                                            </div>
                                            <!--div class="post-view-div">
                                                <ul>
                                                    <li class="not-enough"><a href="#">Not enough data for insights yet</a></li>
                                                    <li class="post-arrow-li"><a href="#">View Post On <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a></li>
                                                    <li class="dot-ellipis"><a href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div--->
                                        </div>
								<?php } } ?>
								</div>
                                      <div class="tab-pane fade" id="Offers" role="tabpanel" aria-labelledby="Offers-tab">
									  <?php foreach($list->getLocalPosts() as $local){
 
  $post_type=$local->getTopicType();
  if($post_type=='OFFER')
  {
$event=$local->getEvent();
$calltoaction=$local->getCallToAction();
$getOffer=$local->getOffer();
$getcreatetime = $local->getCreateTime();
 $media=$local->getMedia();
 $img_url=$media[0]->googleUrl;




if(!empty($event->title)){
$getSchedule=$event->getSchedule();
$date_f=$getSchedule->getStartDate();
$sTime=$getSchedule->getStartTime();
$date_e=$getSchedule->getEndDate();
$end_Time=$getSchedule->getEndTime();
$event_title=$event->title;
// start date
$s_day=$date_f->day;
$s_month=$date_f->month;
$s_year=$date_f->year;
$sTime_h=$sTime->hours;
$sTime_m=$sTime->minutes;
$sTime_s=$sTime->seconds;
$date=date_create($s_year."-".$s_month."-".$s_day);
$start_date= date_format($date,"M d");
if(empty($sTime_m))
{
	$sTime_m2='00'; 
}
else{
	$sTime_m2=$sTime_m;
}
if(empty($sTime_s))
{
	$sTime_s2='00'; 
}
else{
	$sTime_s2=$sTime_s;
}
 $start_time = $sTime_h.":".$sTime_m2.":".$sTime_s2;
 $start_time2=date("g:i A", strtotime($start_time));
	// end date
	$e_day=$date_e->day;
	$e_month=$date_e->month;
	$e_year=$date_e->year;
	$end_Time_h=$end_Time->hours;
	$end_Time_m=$end_Time->minutes;
$end_Time_s=$end_Time->seconds;
	$edate=date_create($e_year."-".$e_month."-".$e_day);
    $end_date= date_format($edate,"M d");
	
	if(empty($end_Time_m))
{
	$end_Time_m2='00'; 
}
else{
	$end_Time_m2=$end_Time_m;
}
if(empty($end_Time_s))
{
	$end_Time_s2='00'; 
}
else{
	$end_Time_s2=$end_Time_s;
}
 $end_time = $end_Time_h.":".$end_Time_m2.":".$end_Time_s2;
 $end_time2=date("g:i A", strtotime($end_time));
$t_date=$start_date.','.$start_time2."-".$end_date.','.$end_time2;	

	
}else{
	$event_title='';
	$start_date='';
	$end_date='';
	$start_time2='';
	$end_time2="";
	$t_date="";
}
								
									  ?>
                                        <div class="all-pos-data">
										
                                            <div class="post-time">
											<?php if(!empty($img_url))
											{?>
											<img src="<?php echo @$img_url;?>" height="200px" width="200px"/>
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											<?php }else{ ?>
											<div class="text_without_img">
											<p class="post-time-text">Posted: <?php echo time_ago_in_php($getcreatetime);?></p>
											</div>
											<?php }?>
											
											
											</div>
                                            <h4><?php echo @$event_title;   ?></h4>
											
                                            <div class="post-date-time"><?php echo $t_date;?></div>
                                            <div class="post-photo">
                                                <h6><?php echo  $local->summary ;   ?></h6>
                                              <?php 
											  if(!empty($getOffer)){   ?>										  
							<a href="<?php echo $getOffer->getRedeemOnlineUrl();   ?>" target="_blank">Redeem Online</a>
												<div class="inner-photo-post">
                                                    <p>Show this code at the store</p>
                                                    <h3><?php echo $getOffer->getCouponCode();  ?></h3>
													<?php 
                                              													
													$start_vdate= date_format($date,"m/d/Y");$end_vdate= date_format($edate,"m/d/Y");  ?>
                                                    <p>Valid <?php echo $start_vdate.',';?><?php echo $start_time2.'-'; ?> <?php echo $end_vdate.',' ;?> <?php echo $end_time2;?></p>
                                                </div>
									          <?php }  ?>
												<?php if(!empty($calltoaction)){
$output = str_replace('_', ' ', $calltoaction->getActionType());
												?>
<a href="<?php  echo $calltoaction->getUrl();  ?>"  ><?php echo $output;   ?>
</a>
	<?php } ?>
	<?php if(!empty($getOffer)){   ?>
                                                <div class="post-term">
                                                    <a href="#">Terms and Conditions <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
													<?php echo $getOffer->getTermsConditions(); ?>
                                                </div>
	<?php  }  ?>
                                            </div>
                                            <!--div class="post-view-div">
                                                <ul>
                                                    <li class="not-enough"><a href="#">Not enough data for insights yet</a></li>
                                                    <li class="post-arrow-li"><a href="#">View Post On <span><i class="fa fa-caret-down" aria-hidden="true"></i></span></a></li>
                                                    <li class="dot-ellipis"><a href="#"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div--->
                                        </div>
								<?php } } ?>
									  </div>
                                      <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">...</div>
                                    </div>
                                </div>
 
<?php 
function time_ago_in_php($timestamp){
  
 // date_default_timezone_set("Asia/Kolkata"); 
 $d = new DateTime($timestamp);
 $new_date =$d->format('Y-m-d\TH:i:s.u');
 
  $time_ago        = strtotime($new_date);

  $current_time    = time();
  $time_difference = $current_time - $time_ago;
  $seconds         = $time_difference;
  
  $minutes = round($seconds / 60); // value 60 is seconds  
  $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
  $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
  $weeks   = round($seconds / 604800); // 7*24*60*60;  
  $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
  $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                
  if ($seconds <= 60){

    return "Just Now";

  } else if ($minutes <= 60){

    if ($minutes == 1){

      return "one minute ago";

    } else {

      return "$minutes minutes ago";

    }

  } else if ($hours <= 24){

    if ($hours == 1){

      return "an hour ago";

    } else {

      return "$hours hrs ago";

    }

  } else if ($days <= 6){

    if ($days == 1){

      return "yesterday";

    } else {

      return "$days days ago";

    }

  } else {
    
  return $d->format('F d,Y');
  }
}
?>

