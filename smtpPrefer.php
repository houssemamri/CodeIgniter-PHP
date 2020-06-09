
                  <div class="col-lg-12" style="text-align: left; margin: 20px auto;">
                      <span id="profileName">
                      <?php
                      include('connection.php');
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
                      $result=$conn->query($sql);
                      $row=$result->fetch_assoc(); ?>
                       <?php echo $smtphey;?>
                      <span>  <?php
                      echo $row['Name'];?> </span>!</span> <br />
                    <span style="font-size: 20px;"> <?php echo $smtpmsgg;?> 
                     </span> 
                  </div>
 
 
  <?php

  $sql="SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
  $result=$conn->query($sql);
  $row=$result->fetch_assoc(); ?>
  <style>
      @media (max-width: 576px) {
          .mobile-img-smtp {
              margin: 20px auto;
          }
      }
  </style>
  <div class="container" >
  <div class="row">
      <div class="col-lg-1">
     
       <img class="img-responsive mobile-img-smtp"  src="/img/enveloppe.png" alt="email preference" /></div><br />
      <div class="col-lg-7 textLeft box-left">
      <h6 class="textLeft" style="font-weight:bold; font-size: 32px;"><?php echo $smtp_email_preference;?></h6>
        <div class="urlSites">
            <span class="urlNames"><?php echo $smtpHost;?></span>
            <input type="text" id="SMTP" class="urlBox" value="<?php echo $row['SMTP'];?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $userName;?></span>
            <input type="text" id="SMTPuser" class="urlBox" value="<?php echo $row['SMTPuser'];?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $pwd;?></span>
            <input type="text" id="SMTPpwd" class="urlBox" value="<?php echo $row['SMTPpwd'];?>" />
        </div>
      </div>
 
  <br /><br />
  <div class="col-lg-4 box-right">
  <button type="button" class="btn btn-lg btn-primary" onClick="updateTable(2);" style="display:table;margin:68px auto;"><?php echo $saveSMTP;?></button>
  </div>
	<div class="clearfix"></div>
	
	<br />
	<br />
	<br />
	<br />
	<br />
	<br />
	
	
<!--SMS credentials add-->	
	<?php
	$get_sms_credential_sql = "SELECT * FROM sms_config WHERE admin_id= '".$_SESSION['user_id']."'";
	$get_sms_credential_query = $conn->query($get_sms_credential_sql);
    $result_row=$get_sms_credential_query->fetch_assoc(); ?>
	
	
	
     <div class="col-lg-1" style=" margin-top: 40px;">
     <img class="img-responsive mobile-img-smtp" src="/img/mobile.png" alt="sms preference" /></div>
     	
	 <br>
    <div class="col-lg-7 textLeft box-left">
    <h6 class="textLeft" style="font-weight:bold;font-size:32px; margin-top: 40px;"><?php echo $smtp_sms_preference;?></h6>

    <input type="text" id="adminId" name="admin_id" value="<?php echo $_SESSION['user_id'];?>" hidden />
    <?php if(!empty($result_row)){?>
    <input type="text" id="idd" value="<?php echo $result_row['id'];?>" hidden />
    <?php } ?>
    <div class="urlSites">
          <span class="urlNames">sid</span>
          <input type="text" id="sid" name="sid" class="urlBox" value="<?php echo $result_row['sid'];?>" />
      </div>
    	<div class="urlSites">
          <span class="urlNames">Token</span>
          <input type="text" id="token" name="token" class="urlBox" value="<?php echo $result_row['token'];?>" />
    	</div>
    	<!--Removed as edward asked on document 16.10.2019-->
    	<!--<div class="urlSites">
          <span class="urlNames"><?php echo $from_number;?></span>
          <input type="text" id="number" name="number" class="urlBox" value="<?php echo $result_row['number'];?>" />
    	</div>-->
	 </div>
	 <div class="col-lg-4 box-right">
		
<button type="button" class="btn btn-lg btn-primary" <?php if(!empty($result_row)){?> onclick="updateSmsCredential()" <?php }else {?>  onclick="saveSmsCredential()"<?php } ?>style="width:260px;display:table;margin:85px auto;">

<?php if(!empty($result_row)){?><?php echo $smtp_update;?><?php }else {?>Save <?php } ?>

</button>

	 </div>
	 <?php echo $credential_check ;?>
	 <div class="clearfix"></div>
	 </div>
	 </div>
	 
	 <script type="text/javascript">
	 	function saveSmsCredential(){
			var adminId = document.getElementById('adminId').value;
			var sid = document.getElementById('sid').value;
			var token = document.getElementById('token').value;
			var number = document.getElementById('number').value;
			$.ajax({
					type:'POST',
					url:"save_sms_credential.php",
					data:{adminId:adminId,sid:sid,token:token,number:number},
					success:function(data){
						console.log(data); }
					})
		}
		function updateSmsCredential(){
			var adminId = document.getElementById('adminId').value;
			var sid = document.getElementById('sid').value;
			var token = document.getElementById('token').value;
			var number = document.getElementById('number').value;
			var idd = document.getElementById('idd').value;
			$.ajax({
					type:'POST',
					url:"update_sms_credential.php",
					data:{adminId:adminId,sid:sid,token:token,number:number,idd:idd},
					success:function(data){
						console.log(data); }
					})
		}
	 </script>