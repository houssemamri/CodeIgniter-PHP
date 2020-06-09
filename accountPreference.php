<?php // GOOGLE MY BUSINESS
error_reporting(0);
@ini_set('display_errors', 0);
?>

<div class="tab-pane fade show <?php echo $main;?>" id="home">
                  <div class="col-lg-12" style="text-align: left;">
                      <span id="profileName">
                      <?php
                      include('connection.php');
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
                      $result=$conn->query($sql);
                      $row=$result->fetch_assoc();
                      $path="";
                      $sql1="SELECT * FROM imageUser WHERE UID=" . $_GET['id'];
                      $result1=$conn->query($sql1);
                      $row1=$result1->fetch_assoc();
                      $sql1="SELECT * FROM imageUser WHERE UID=" . $_GET['id'];
                      $result1=$conn->query($sql1);
                      $row1=$result1->fetch_assoc();
                      $email=explode("-",$row['Email']);?>
                       <?php echo $profile_google_greeting;?>
                     <span style="color: #FF2700"> <?php
                      echo $row['Name'];?> </span>!</span> <br />
                    <span style="font-size: 20px;"> <?php echo $profile_google_greeting_msg;?>
                     </span> 
                  </div>
                </div><br /><br />

<?php 
 //include('connection.php');
 $sql1="SELECT * FROM oauth_user WHERE user_id=".$_SESSION['user_id'];
				$result=$conn->query($sql1);
   $data=$result->fetch_array();
				// $row=$result->fetch_assoc();
				/* while($row=$result->fetch_assoc())
				  {
				$data=$row;	  
				  } */
				  if(!empty($data)){
				 $client_id= $data['client_id']; 
			 $client_secret=$data['client_secret'];
				  }else{
				 $client_id= ''; 
			 $client_secret='';  
				  }
				 // print_r($data);
				?>
 <div class="container">  
   <div class="row" style="position: relative;">
       <style>
           .avatar-article2{
               position: absolute;
               left: -260px;
               top: 137px;
               width: 130px;
           }
           .bubble-article2 > span{
               position: absolute;
               top: -180px;
               left: 150px;
               width: 100px;
               font-size: 0.75rem;
               max-height: 160px;
               font-weight: 900;
               line-height: 1.5;
           }
           .bubble-article2 > img{
               position: absolute;
               top: -240px;
               left: 85px;
               max-width: 210px;
               max-height: 200px;
               width: 210px;
               height: 200px;
           }

           .avatar-article-img2{
               position: absolute;
               top: -80px;
           }
       </style>
       <?php
       $sql = 'select avatar,bubble from UserTable where UID = "'.$_SESSION['user_id'].'"';
       $result = $conn->query($sql);
       $row = $result->fetch_array();
       if(is_null($row['avatar'])){
           $row['avatar'] = 1;
       }
       if(is_null($row['bubble'])){
           $row['bubble'] = 1;
       }
       ?>
       <div class="avatar-article avatar-article2">
           <div class="bubble-article2">
               <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
               <span><?=$avatarTextAccountPre?></span>
           </div>
           <img class="avatar-article-img2" src="avatar/img/avatar/<?=$row['avatar']?>.png">
       </div>
	<div class="col-lg-4">
		<img class="img-responsive todo" src="img/gmb-logo.jpg" alt="" />
	</div>
   	<div id="google_div">
   <form class="form-transparent" id="submit_google" action="javascript:void(0);" method="POST">
      <h6 class="textLeft" style="font-weight:bold;font-size: 32px;"><?php echo $googleacc_access;?>:</h6>
      <div class="col-lg-8 textLeft box-left">
        <div class="urlSites">
            <span class="urlNames"><?php echo $client_idd;?></span>
            <input type="text" name="client_id"  class="urlBox" value="<?php echo $client_id;  ?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $client_secrett;?></span>
            <input type="text" name="client_secret" class="urlBox" value="<?php echo $client_secret;  ?>" />
        </div><br><br><br>
		<input type="hidden" name="ajax_post" value="save" />
       
      </div>


 <div class="col-lg-4 box-right">
 	 <button class="btn btn-lg btn-primary"  style="display:table;margin:0 auto;" type="submit"><?php echo $profile_google_save;?></button>
 </div>
<div class="clearfix"></div>
    </form> </div>
	  <br /><br />
	  
	  <?php   if(!empty($data)){  include('user_google.php');  } ?>

		
<?php // FACEBOOK SETTINGS ?>
<?php
include('connection.php');
 $sql="SELECT * FROM fb_setting WHERE user_id=" . $_GET['id'];

$result=$conn->query($sql);
$row=$result->fetch_assoc();
if(empty($row)){
$tabletype="Save";
}else{
$tabletype="Update";	
	
}

?> 
<div class="col-lg-2">
	<img class="img-responsive todo" src="img/facebook_logo_thumb.jpg" alt="" />
</div>
     <div class="col-lg-12"><h6 class="textLeft" style="font-weight:bold;font-size:32px;"><?php echo $editFacebookSetting;?></h6></div>
    <br>
    <div class="col-lg-8 textLeft box-left">
      <input type="text" id="user_id" value="<?php echo $_GET['id'];?>" hidden />
      <div class="urlSites">
          <span class="urlNames"><?php echo $profile_facebook_page_link;?></span>
          <input type="text" id="fb_link" name="fb_link" class="urlBox" value="<?php echo $row['fb_link'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames"><?php echo $profile_facebook_app_id;?></span>
          <input type="text" id="fb_app_id" name="fb_app_id" class="urlBox" value="<?php echo $row['fb_app_id'];?>" />
      </div> 
	  <div class="urlSites">
          <span class="urlNames"><?php echo $profile_facebook_app_secret_key;?></span>
          <input type="text" id="fb_app_secret" name="fb_app_secret" class="urlBox" value="<?php echo $row['fb_app_secret'];?>" />
      </div>
	  <div class="urlSites">
          <span class="urlNames"><?php echo $profile_facebook_page_id;?></span>
          <input type="text" id="fb_page_id" name="fb_page_id" class="urlBox" value="<?php echo $row['fb_page_id'];?>" />
      </div>
     </div>
	<div class="col-lg-4 box-right">
		
<button type="button" class="btn btn-lg btn-primary" onClick="updateUserFB('<?php echo $tabletype ; ?>');" style="display:table;margin:0 auto;"><?php echo $profile_facebook_update_details;?></button>
	</div>
	<div class="clearfix"></div>
</div>
</div>
<br /><br />
	  
	  <?php   if(!empty($row)){  include('user_fb.php');  } ?>