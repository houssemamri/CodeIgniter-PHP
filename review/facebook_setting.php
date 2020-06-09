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
<div class="row">
    <h6 style="font-weight:bold;font-size:32px;"><?php echo $editProfile;?></h6>
    <div class="col-lg-12 text-right">
      <input type="text" id="user_id" value="<?php echo $_GET['id'];?>" hidden />
      <div class="urlSites">
          <span class="urlNames">Facebook Page Link</span>
          <input type="text" id="fb_link" name="fb_link" class="urlBox" value="<?php echo $row['fb_link'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames">Facebook App Id</span>
          <input type="text" id="fb_app_id" name="fb_app_id" class="urlBox" value="<?php echo $row['fb_app_id'];?>" />
      </div> 
	  <div class="urlSites">
          <span class="urlNames">Facebook App Secret Key</span>
          <input type="text" id="fb_app_secret" name="fb_app_secret" class="urlBox" value="<?php echo $row['fb_app_secret'];?>" />
      </div>
	  <div class="urlSites">
          <span class="urlNames">Facebook Page Id</span>
          <input type="text" id="fb_page_id" name="fb_page_id" class="urlBox" value="<?php echo $row['fb_page_id'];?>" />
      </div>
     </div>
</div>
<br /><br />

<button type="button" class="btn btn-lg btn-primary" onClick="updateUserFB('<?php echo $tabletype ; ?>');" style="display:table;margin:0 auto;">Update Details</button>
<br /><br />
  
 <br /><br />
	  
	  <?php   if(!empty($row)){  include('user_fb.php');  } ?>