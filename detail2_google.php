 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




 
<?php
session_start();
$access=	json_decode($_SESSION['access_token']);
$access_token=$access->access_token;
$curl = curl_init();
$name="accounts/100928649975105038548/locations/12481351387678745559";
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
 // echo "<pre>";
//  print_r($res);
?>

<section class="google-demo">    
    <div class="container">
      <div class="inner-review">
        <div class="full-row">
		
          <ul>
          <li><a href="#"><img src="/img/icon.png"></a></li>
          <li><a href="#"><img src="/img/logo_google.png"></a></li>
          <li>My Business</li>
        </div>
        <div class="inner-tabview">
          <div class="left-bar">
            <h2> <?php echo $res->locationName;   ?></h2>
            <p><?php echo $res->address->addressLines['0'];   ?></br>
		<?php echo $res->address->postalCode;   ?>,<?php echo $res->address->locality;   ?> <?php echo $res->address->country;   ?> </p>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
            </li>
			
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Review</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-info-circle" aria-hidden="true"></i>info</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false"><i class="fa fa-picture-o" aria-hidden="true"></i>Photo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-user" aria-hidden="true"></i>User</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link active id="manage-tab" data-toggle="tab" href="#manage" role="tab" aria-controls="manage-tab" aria-selected="false"><i class="fa fa-user" aria-hidden="true"></i>Manage locations</a>
            </li>

          </ul>
        </div>
        <div class="right-bar">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="home-content-main">
                 <h2>Where can I get some?</h2>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
               </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="tab1" data-toggle="tab" href="#home1" role="tab" aria-controls="tab1" aria-selected="true">ALL</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">REPLIED</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact1" role="tab" aria-controls="contact" aria-selected="false">HAVEN'T REPLIED</a>
                  </li>
                </ul>
                <div class="tab-content second" id="myTabContent">
                  <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
                    <div class="review-list">
                      <ul class="review-user">
                        <li><img src="/img/dummy.png"></li>
                        <li><h5>Lorem Insum</h5>
                            <p>5 weeks ago</p>
                        </li>
                        <li><a href="#"><img src="/img/dot.png"></a></li>
                      </ul>
                      <div class="inner-star-rating">
                        <ul class="star-rating">
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                        </ul>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        <ul class="review-reply">
                          <li><a href="#"><img src="/img/reply.png">REPLY</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="review-list">
                      <ul class="review-user">
                        <li><img src="dummy.png"></li>
                        <li><h5>Lorem Insum</h5>
                            <p>5 weeks ago</p>
                        </li>
                        <li><a href="#"><img src="dot.png"></a></li>
                      </ul>
                      <div class="inner-star-rating">
                        <ul class="star-rating">
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li class="orange"><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                          <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                        </ul>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                        <ul class="review-reply">
                          <li><a href="#"><img src="reply.png">REPLY</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="inner-data-content">
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                  </div>
                  <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="inner-data-content">
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </div>
                  </div>
                </div>


            </div>
            
            <div class="tab-pane fade show active" id="manage" role="tabpanel" aria-labelledby="manage-tab">
              <div class="location-content">
                <div class="full-location">
                  <ul class="location-title">
                    <li>Location</li>
                  </ul>  
                  <ul class="location-right">
                    <li><div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            All locations (<?php echo count($res->locations);  ?>)
                          </button>
                          <!--div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Published (6)</a>
                            <a class="dropdown-item" href="#">Demo</a>
                            <a class="dropdown-item" href="#">Demo</a>
                          </div-->
                        </div>
                     </li>
                     
                  </ul>
                </div>
                <div class="location-loop">
                  <ul>
                    <li class="text-center">
                      <div class="form-check">
                        <label>
                          <input type="checkbox" name="check"> <span class="label-text"></span>
                        </label>
                      </div>
                    </li>
                    <li class="name-list">
                      <a href="#">Name<i class="fa fa-long-arrow-up" data-unicode="f176"></i></a>
                    </li>
                    <li>Status</li>
                     <li></li>
                  </ul>
                </div>
				 <?php 
foreach($res->locations as $res1){ ?> 

                 <div class="location-loop">
                  <ul>
                    <li class="text-center">
                      <div class="form-check">
                        <label>
                          <input type="checkbox" name="check"> <span class="label-text"></span>
                        </label>
                      </div>
                    </li>
                    <li class="name-list">
                      <a  onclick="get_detail('<?php echo $res1->name;   ?>')" href="javascript:void(0)"><h6><?php echo $res1->locationName;   ?></h6>
                        <p><?php echo $res1->address->addressLines['0'];   ?></br>
						<?php echo $res1->address->postalCode;   ?>,<?php echo $res1->address->locality;   ?> <?php echo $res1->address->country;   ?> </p>
                      </a>
                    </li>
                     <li><?php if($res1->locationState->isPublished=="1"){  echo "Published" ;   }?></li>
                  </ul>
                </div>
<?php } ?> 
              </div>
			  </div>
            
          <div class="tab-pane fade " id="info" role="tabpanel" aria-labelledby="info-tab">
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
foreach($res->photos->interiorPhotoUrls as $res1){	?>
	    <img height="200px" width="200px" src='<?php echo $res1;  ?>'>	
<?php 
}
?>				  
							  
                </div>
               
              </div>
            </div>
		  </div>
		  
		  
		   <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="location-content">
                <div class="full-location">
                  <!-- <ul class="location-title">
                    <li>Info</li>
					
                  </ul>  --> 
                  
				  <div class="profile-title">
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
		  
        </div>
      </div>
      </div>
    </div>
	</div>
  </section>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
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
  padding: 0 55px 0 75px;
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
</style>
