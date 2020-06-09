<style type="text/css">
	.text-color{
		color: #006ac0;
		font-weight:bold;
	}
</style>

 <div class="row">
 
 <div class="col-lg-12" style="margin-bottom: 10px;">
                      <?php
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
                      $result=$conn->query($sql);
                      $row=$result->fetch_assoc();
                     ?>
				      <div style="text-align: left; margin-bottom: 8%; " >
				      <span id="profileName" >   
				      Hey
				      <span > <?php echo $row['Name'];?> </span>!<br />
				      </span>
				      <span style="font-size: 20px;">
				      	<?php echo $managepreferwelcom;?>
				      </span>
				      </div>                  
                  </div>
 </div>



<?php

  $sql="SELECT * FROM UserPrefer WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  if($result->num_rows>0)
    $row=$result->fetch_assoc();?>
  <div class="row">
     <!-- <h6 class="center-text" style="font-weight:bold;font-size:32px;"><?php echo $editLinks;?>:</h6>-->
      <div class="col-lg-1" style="position: relative;">
          <style>
              .avatar-article8{
                  position: relative;
                  left: -140px;
                  top: 137px;
                  width: 120px;
              }
              .bubble-article8 > span{
                  position: absolute;
                  top: -180px;
                  left: 125px;
                  width: 130px;
                  font-size: 11px;
                  max-height: 160px;
                  font-weight: 900;
                  line-height: 1.5;
              }
              .bubble-article8 > img{
                  position: absolute;
                  top: -240px;
                  left: 85px;
                  max-width: 210px;
                  max-height: 200px;
                  width: 210px;
                  height: 200px;
              }

              .avatar-article-img8{
                  position: absolute;
                  top: -80px;
                  width: 120px;
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
          <div class="avatar-article avatar-article8">
              <div class="bubble-article8">
                  <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
                  <span><?=$avatarTextManagePre?></span>
              </div>
              <img class="avatar-article-img8" src="avatar/img/avatar/<?=$row['avatar']?>.png">
          </div>
      </div>
      <div class="col-lg-11 text-right">
      <div class="container">
      	<div class="row">
      		<div class="col-lg-4">
      			<input type="text" id="UID" value="<?php echo $_GET['id'];?>" hidden />
            <img class="text-left" src="<?php echo $reviewans1;?>" />
      		</div>
			  <div class="col-lg-8">
			  	<div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 1</span>
                <input type="text" id="s1" class="urlBox" value="<?php echo $row['S1'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 2</span>
                <input type="text" id="s2" class="urlBox" value="<?php echo $row['S2'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 3</span>
                <input type="text" id="s3" class="urlBox" value="<?php echo $row['S3'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s4" class="urlBox" value="<?php echo $row['S4'];?>" />
            </div><br />
            <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(1);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
			  </div>
		<div class="clearfix"></div>
      	</div>
      	<div class="row">
      		<div class="col-lg-4">
      			<img class="text-left " src="<?php echo $reviewans2;?>"/>
      		</div>
			  <div class="col-lg-8">
			  	             <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 1</span>
                <input type="text" id="s5" class="urlBox" value="<?php echo $row['S5'];?>"/>
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 2</span>
                <input type="text" id="s6" class="urlBox" value="<?php echo $row['S6'];?>"/>
           </div>
           <div class="urlSites">
                 <span class="urlNames"><?php echo $Situation;?> 3</span>
                 <input type="text" id="s7" class="urlBox" value="<?php echo $row['S7'];?>"/>
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s8" class="urlBox" value="<?php echo $row['S8'];?>"/>
           </div><br />
           <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(2);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
			  </div>
      	</div>
      	<div class="row">
      		<div class="col-lg-4">
      			 <img class="text-left" src="<?php echo $reviewans3;?>"/>
      		</div>
			  <div class="col-lg-8">
			  	           <div class="urlSites">
               <span class="urlNames"><?php echo $Situation;?> 1</span>
               <input type="text" id="s9" class="urlBox" value="<?php echo $row['S9'];?>"/>
          </div>
          <div class="urlSites">
              <span class="urlNames"><?php echo $Situation;?> 2</span>
              <input type="text" id="s10" class="urlBox" value="<?php echo $row['S10'];?>"/>
         </div>
          <div class="urlSites">
               <span class="urlNames"><?php echo $Situation;?> 3</span>
               <input type="text" id="s11" class="urlBox" value="<?php echo $row['S11'];?>"/>
          </div>
          <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s12" class="urlBox" value="<?php echo $row['S12'];?>"/>
           </div><br />
           <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(3);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
			  </div>
      	</div>
      </div>
      </div>
  </div>
  <br /><br /><br />

