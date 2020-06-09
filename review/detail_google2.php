
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<?php 
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

?>

 
<?php
include_once "connection.php";
session_start();

$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM `oauth_user` where user_id=".$_SESSION['user_id'];
	$result=$conn->query($sql);
   $data=$result->fetch_array();
 
//$access=	json_decode($_SESSION['access_token']);
  $access_token= $data['access_token'];
$curl = curl_init();

 $name=$_REQUEST['name'];

//$name="accounts/100928649975105038548/locations/12481351387678745559";
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mybusiness.googleapis.com/v3/".$name,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$access_token,
    
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
  $res=json_decode($response);

  


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mybusiness.googleapis.com/v3/".$name."/reviews",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$access_token,
    
  ),
));

$response1 = curl_exec($curl);
$err = curl_error($curl);


  $comment=json_decode($response1);
/*  echo "<pre>";
  print_r($comment);
  echo "</pre>";  */ 
?>
<style>
.checked {
    color: orange;
}
</style>
<section class="google-demo">    
    <div class="container">
      <div class="inner-review">
        <div class="full-row">
		
          <ul>
          <li><img src="/img/icon.png"></li>
          <li><img src="/img/logo_google.png"></li>
          <li>My Business</li>
        </div>
        <div class="inner-tabview">
          <div class="left-bar">
            <h2> <?php echo $res->locationName;   ?></h2>
            <p><?php echo $res->address->addressLines['0'];   ?></br>
		<?php echo $res->address->postalCode;   ?>,<?php echo $res->address->locality;   ?> <?php echo $res->address->country;   ?> </p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
              <a class="nav-link " id="home-tab" data-toggle="tab"   href="#home" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab" data-toggle="tab"   href="#profile1" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Review</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="info-tab" data-toggle="tab"  href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-info-circle" aria-hidden="true"></i>info</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="photo-tab" data-toggle="tab"   href="#photo" role="tab" aria-controls="photo" aria-selected="false"><i class="fa fa-picture-o" aria-hidden="true"></i>Photo</a>
            </li>
           <!--li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab"  href="#profile" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Review</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="photo-tab" data-toggle="tab"  onclick="show_hide('photo')" href="#photo" role="tab" aria-controls="photo" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Photo</a>
            </li-->
            <li class="nav-item">
              <a class="nav-link" onclick="get_detail2('manage')"  id="manage-tab"  href="javascript:void(0)" ><i class="fa fa-user" aria-hidden="true"></i>Manage locations</a>
            </li>

          </ul>
        </div>
        <div class="right-bar">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="home-content-main">
                 <h2>Where can I get some?</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
               </div>
            </div>
            <div class="tab-pane fade show active" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
               
                
				 
				   <?php  foreach($comment->reviews as $key=>$com){
					   
$rating= $com->starRating;
if($rating=="ONE"){	$rate=1; }
if($rating=="TWO"){	$rate=2; }
if($rating=="THREE"){	$rate=3; }
if($rating=="FOUR"){	$rate=4; }
if($rating=="FIVE"){	$rate=5; }
				   //print_r($com); ?>
				  
                    <div class="review-list">
                      <ul class="review-user">
                        <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                        <li><h5><?php echo $com->reviewer->displayName ; ?></h5>
                            <p><?php echo time_elapsed_string($com->createTime); ?></p>
                        </li>
                        <li></li>
                      </ul>
                      <div class="inner-star-rating">
					  <?php for($i=1; $i<=5; $i++){  
					  
if($i>$rate){ ?>
	<span class="fa fa-star "></span>
	
					  <?php }else{  ?> <span class="fa fa-star checked"></span>  <?php }	 }	?>

					  
					
                        
                        <p ><?php echo $com->comment ; ?> </p>
                        <ul class="review-reply">
                        <li><a onclick="review_reply1('<?php echo  $com->reviewId;  ?>','open');" href="javascript:void(0)"><img src="/img/reply.png">REPLY</a></li>
						<div id="1div_rely_owner_<?php echo  $com->reviewId;  ?>" style="display:none">
						<li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
						 <li><h5>(Owner)</h5>
						  <p id="1replay_comment_<?php echo  $com->reviewId;  ?>">  <p>
						  </div>
						  <div class="reply-msg" style="display:none" id="1div_<?php echo  $com->reviewId;  ?>">
						  <textarea rows="6" cols="70" class="form-control reply_textarea "  name="reply" id="1text_<?php echo  $com->reviewId;  ?>" > </textarea>

<input type="button"  class="btn btn-primary reply_button" value="Post Reply"  onclick="reply_post1('<?php echo  $com->reviewId;  ?>','<?php echo  $name;  ?>','model');" />						 
<input type="button" class="btn btn-primary cancle_button" value="Cancel" onclick="review_reply1('<?php echo  $com->reviewId;  ?>','hide');" />		
 </div>	
                        </ul>
                      </div>
                    </div>
                     <?php } ?>
                 


            </div>
            
            <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
              <div class="location-content">
                <div class="full-location">
                  <!-- <ul class="location-title">
                    <li>Info</li>
					
                  </ul>  --> 
                  
				  <div class="info-title">
          <div class="info-bg">
            <img src="img/map-bg.png" alt="">
          </div>
          <div class="location-name">
				  <?php echo $res->locationName;  ?>
          </div>

                <div class="info-number">
                  <ul>
                  <li><i class="fa fa-phone" aria-hidden="true"></i><?php echo $res->primaryPhone;  ?>	</li>
                  <li><i class="fa fa-globe" aria-hidden="true"></i><?php echo $res->websiteUrl;  ?>	</li>			  
                  <li> <i class="fa fa-location-arrow" aria-hidden="true"></i><?php echo $res->address->addressLines[0];  ?>		</li>	
                  </ul>          	   	  		 			  
				  </div>
                  </div>
                  <div class="right-google-map">
<div class="map">Your business is live on Google</div><div class="map-link"><a href="<?php echo $res->metadata->mapsUrl;  ?>" target="_blank"><div class="view"><img src="img/map-img.png">View on Maps</div></a></div>    </div>
               
              </div>
            </div>
		  </div>
		  
		   <div class="tab-pane fade " id="photo" role="tabpanel" aria-labelledby="photo-tab">
              <div class="location-content">
                <div class="full-location">
                  <!-- <ul class="location-title">
                    <li>Photo</li>
					
                  </ul>  
 -->                  
				  <div class="photo-title">
				  <?php 
foreach($res->photos->interiorPhotoUrls as $key1=>$res1){	?>
<div id="div_image_model_<?php echo  $key1;  ?>">
	    <img height="200px" width="200px" src='<?php echo $res1;  ?>'>	
		<a class="img_del" onclick="delete_media_model_('<?php echo $key1  ?>','<?php echo $name;   ?>');"; href="javascript:void(0);">Delete</a></div>
<?php 
}
?>				  
							  
                </div>
               
              </div>
            </div>
		  </div>
		  
		  
		  
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script>
 function delete_media_model(key,name){
	
var url = "gbm/examples/delete_media.php";

  $.ajax({
           type: "POST",
           url: url,
           data: {'key':key,'name':name}, // serializes the form's elements.
           success: function(data)
           {
			   $("#delete_media_model_"+id).remove();
				
            
           }
         });

   // e.preventDefault(); // avoid to execute the actual submit of the form.
}
function review_reply1(id,hideshow){
	
if(hideshow=="open"){
   $("#1div_"+id).show();
}else{
	$("#1div_"+id).hide();
}

   // e.preventDefault(); // avoid to execute the actual submit of the form.
}
function reply_post1(id,name){
	var url = "gbm/examples/review_post.php";
var text=$("#1text_"+id).val();
  $.ajax({
           type: "POST",
           url: url,
           data: {'id':id,'text':text,'name':name}, // serializes the form's elements.
           success: function(data)
           {
			  if(data=="done"){
				 $('#1replay_comment_'+id).html(text);
				 
				   $("#1div_"+id).hide();
				   $("#1div_rely_owner_"+id).show();
				  
			  }
            
           }
         });

   // e.preventDefault(); // avoid to execute the actual submit of the form.
}
</script>  
 <style>
  .reply-msg textarea {
    border-left: 0 none;
    border-radius: 0;
    border-right: 0 none;
    border-top: 0 none;
    //height: auto;
    margin-top: 15px;
   /* max-height: 35px;*/
    padding: 0;
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}
.reply-msg .form-control:focus {
  background-color: #ffffff;
  border-color: #ddd;
  box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
  color: #495057;
  outline: 0 none;
}
.reply-msg input {
    background: transparent;
    border: 1px solid transparent;
    border-radius: 5px;
    line-height: 26px;
    margin-top: 0;
    padding: 0px 25px 4px 0;
    color: #616771;
    font-size: 13px;
}
.reply-msg input:hover{
	  background: transparent;
	  box-shadow: 0 0px 0px transparent;
  border: 1px solid transparent;
  color:#616771;
}
a:hover{
  text-decoration: none;
}
  .inner-review {
  border: 1px solid #454545;
  padding: 50px 0 20px 0;
}
.full-row {
  box-shadow: 0px 4px 3px 0 #050505;
  padding: 0 15px 20px;
  width: 100%;
  z-index: 9999;
  display: inline-block;
}
.full-row ul{
  margin:0;
}
.full-row img {
  margin-right: 15px;
}
.full-row ul {
  list-style: outside none none;
  padding: 0;
}
.full-row ul li{
display: inline-block;
}
.full-row ul li:nth-child(2) img{
  margin-right: 3px;
}
.inner-tabview {
  background: #f0f0f0;
  display: table;
  padding: 20px 0;
  width: 100%;
}
.inner-tabview .left-bar {
  float: left;
  width: 25%;
  padding-top: 25px;
}
.inner-tabview .right-bar {
  float: right;
  padding:20px 70px;
  width: 75%;
}
#myTab.nav {
  display: block;
  width: 100%;
}
.nav-tabs .nav-item {
  margin-bottom: 0;
}
.nav-tabs {
  border-bottom: 0px;
}
.nav-tabs li a{
  color: #454545;
  font-size: 16px;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  background-color: #d7d7d7;
  border: 0 none;
  color: #000;
  font-size: 16px;
}
.nav-tabs .nav-link {
  border: 0px;
  border-top-left-radius: 0;
  border-top-right-radius:0;
}
.photo-title img {
  margin-bottom: 4px;
}
.nav-link {
  display: block;
  padding: 13px 1rem;
}
.left-bar h2 {
  font-size: 18px;
  font-weight: bold;
  padding-left: 15px;
}
.left-bar p {
  font-size: 16px;
  padding-left: 15px;
}
#myTab2 li a {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
}
#myTab2.nav-tabs .nav-item.show .nav-link, #myTab2.nav-tabs .nav-link.active {
  background-color: transparent;
  border: 0 none;
  color: #0776ff;
  border-bottom: 2px solid #0776ff; 
}
#myTab2.nav-tabs {
  border-bottom: 2px solid #dddddd;
}
.right-bar .tab-content.second {
  background: #ffffff none repeat scroll 0 0;
  margin-top: 20px;
  display: inline-block;
  width: 100%;
}
.review-user {
  list-style: outside none none;
  display: inline-block;
  width: 100%;
  padding: 0;
  margin-bottom: 0;
}
.review-list ul{
    list-style: outside none none;
  display: inline-block;
  width: 100%;
  padding: 0;
  margin-bottom: 0;
}
.review-user li {
float: left;
}
.review-user li:first-child {
  margin-right: 15px;
}
.review-user li:last-child {
float: right;
}
.inner-star-rating {
  //padding: 0 55px 0 75px;
}
.review-user li h5 {
  font-size: 18px;
  margin-bottom: 0;
  margin-top: 6px;
}
.review-user li p {
  font-size: 14px;
  margin-bottom: 0;
  margin-top: 0px;
  color: #969696;
}
.star-rating li {
  float: left !important;
  margin-right: 5px !important;
}
.star-rating li a{
color: #d3d3d3;
}
.star-rating li.orange a{
color: #ed6c20;
}
.star-rating li a:hover, .star-rating li a:active, .star-rating li a:focus{
color: #ed6c20;
}
.review-reply img {
  margin-right: 12px;
}
.review-reply a {
 color: #757575;
}
.review-list {
  border-bottom: 1px solid #dddddd;
  padding: 25px;
}
.left-bar li.nav-item i {
  font-size: 25px;
  margin-right: 12px;
  color: #717171;
  width: 25px;
}
.left-bar li.nav-item a.nav-link.active i {
  font-size: 25px;
  margin-right: 12px;
  color: #000;
}
.inner-data-content {
  line-height: 30px;
  padding: 25px;
}
.location-content {
  background: #ffffff none repeat scroll 0 0;
}
.full-location {
  padding: 25px;
  display: inline-block;
  width: 100%;
}
.full-location ul{
padding:0;
list-style: none;
margin-bottom: 0;
}
.full-location .location-title{
  float: left;
}
.full-location .location-title li{
font-size: 20px;
}
.full-location .location-right{
  float: right;
}
.location-right .dropdown button {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
  border: 0 none;
  color: #000000;
}
.location-right .btn-secondary.active:not(:disabled):not(.disabled), .location-right .btn-secondary:active:not(:disabled):not(.disabled), .location-right .show > .btn-secondary.dropdown-toggle {
  background-color: transparent;
  border-color: transparent;
  color: #000;
}
.location-right .btn-secondary.focus, .btn-secondary:focus {
  box-shadow: 0 0 0 0 rgba(108, 117, 125, 0.5);
}
.location-right li {
  display: inline-block;
}
.location-btn {
  background: #4285F4;
  border-radius: 5px;
  color: #ffffff;
  padding: 7px 18px;
}
.location-btn:hover {
  background: #4285F4;
  border-radius: 5px;
  color: #ffffff;
  }



.location-loop label {
  color: #666666;
  cursor: pointer;
  font-size: 25px;
  position: relative;
}
.location-loop ul{
  list-style: none;
  margin-bottom: 0;
  padding:0;
}
.location-loop input[type="checkbox"]{
  position: absolute;
  right: 9000px;
}

/*Check box*/
.location-loop input[type="checkbox"] + .label-text:before{
  content: "\f096";
  font-family: "FontAwesome";
  speak: none;
  font-style: normal;
  font-weight: normal;
  font-variant: normal;
  text-transform: none;
  line-height: 1;
  -webkit-font-smoothing:antialiased;
  width: 1em;
  display: inline-block;
  margin-right: 5px;
}
.info-number li {
  color: #565656;
  font-size: 16px;
  margin-bottom: 15px;
}
.info-number li i {
  color: #4285f4;
  font-size: 18px;
  margin-right: 10px;
}
.view img {
  margin-right: 10px;
}
.view{
 color: #454545;
}
.right-google-map .map {
  color: #686868;
  font-size: 20px;
}
.location-loop input[type="checkbox"]:checked + .label-text:before{
  content: "\f14a";
  color: #2980b9;
  animation: effect 250ms ease-in;
}

.location-loop input[type="checkbox"]:disabled + .label-text{
  color: #aaa;
}

.location-loop input[type="checkbox"]:disabled + .label-text:before{
  content: "\f0c8";
  color: #ccc;
}
.name-list > a {
  color: #454545;
  font-size: 16px;
  padding-top: 0px;
  display: inline-block;
}
.name-list > a i{
margin-left: 5px;
}
.location-loop ul li {
  float: left;
  width: 25%;
}
.location-loop {
  display: inline-block;
  width: 100%;
  border-bottom: 1px solid #ddd;
}
.location-loop li {
  font-size: 15px;
  margin-bottom: 0;
  margin-top: 8px;
  color: #7a7a7a;
}
.location-loop h6 {
  float: left;
  margin-bottom: 0 !important;
  width: 100%;
  font-size: 15px;
}
.location-loop p {
  color: #7a7a7a;
  display: table;
  font-size: 13px;
  line-height: 15px;
  margin-top: 20px;
}
.checked-icon i {
  color: #4caf50;
  font-size: 20px;
  margin-right: 5px;
  position: relative;
  top: 2px;
}
.review-deatil-anchor a {
  display: inline-block;
  padding-top: 18px;
}
.location-loop ul li:first-child {
  width: 10%;
}
.form-check {
  display: block;
  padding-left: 10px;
  position: relative;
}
.location-loop ul li:nth-child(2) {
  width: 40%;
}
.info-title {
  float: left;
  width: 50%;
  padding-right: 15px;
}
.right-google-map {
  float: right;
  width: 50%;
  padding-left: 15px;
}
.info-bg img {
  width: 100%;
}
.location-name {
  background: #4285F4;
  padding: 15px;
  color: #fff;
  font-size: 20px;
}
.info-number {
  border-width: 0 1px 1px 1px;
  padding: 15px;
  border-color: #ddd;
  border-style: solid;
}
.inner-star-rating p {
  max-width: 540px !important;
  word-wrap: break-word;
}
img.user_img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
}
.inner-tabview .right-bar {
    float: right;
    padding: 20px 70px;
    width: 75%;
    max-height: 500px;
    overflow-y: scroll;
}
.inner-review{
  background:#F0F0F0 !important;
}
</style>
