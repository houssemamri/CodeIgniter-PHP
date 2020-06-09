<?php



?>

<style type="text/css">
	.circle{
		border-radius: 100% !important;
		text-transform: none !important;
	}
	.td-width{
		width: 130px;
	}
</style>

  <body>

     <div class="container">
     <div class="row" style="margin-bottom: 3%; text-align: center;">
     <div class="col-lg-1"></div>
     	<div class="col-lg-2">
     		<img src="img/communication_exchange.png" class="img-responsive todo" alt="communication exchange" />
     	</div>
		 <div class="col-lg-8">
		 	<h1><?php echo $profile_communication_exchange;?></h1>
		 </div>
		 <div class="col-lg-1"></div>
     </div>
    <div class="row">
    
  <div class="col-lg-12" style="    text-align: center; margin-bottom: 10px;">
  <h1 style="font-size:24px !important; margin-bottom: 15px;"><?php echo $profile_last_email_sent;?>:</h1>
  	 <table class="table table-striped table-bordered compact" style="text-align:center; width: 100%"  id="myTabl">
			    <thead>
			      <tr>				
			        <th><?php echo $group_Id;?></th>
			        <th><?php echo $profile_email_sent_subject;?></th>			        
			        <th><?php echo $date_time;?></th>		        
			      </tr>
			    </thead>
			    <tbody>
<?php 

$sqlViewEmaillog = "SELECT el.*,EM.ListName FROM emaillog as el left join EmailListMain as EM on EM.LID=el.gid WHERE el.userid= '".$_SESSION['user_id']."' ORDER BY id DESC" ;
//echo $sqlViewEmaillog;die("here");
$resultViewEmaillog = mysqli_query($conn,$sqlViewEmaillog);
 	
$row = mysqli_fetch_assoc($resultViewEmaillog);
$id      = 	$row['id'];
$gname   = $row['ListName'];
$email_id = $row['email_id'];
$subject = $row['subject'];
$email_body = $row['email_body'];
$gid = $row['gid'];
$template_id = $row['template_id'];
$send_date = $row['send_date'];
$send_time = $row['send_time'];
$dateTime = $send_date." ".$send_time; 

?>			    




<!--Table-->
			<tr>
			 
			    	<td class="td-width"><?php echo $gname;?></td>
	
			            <td class="td-width"><input type="hidden" id="subject<?php echo $i;?>" value="<?php echo $subject;?>" name="subject" /> <?php echo $subject;?></td>

			        <td class="td-width"><?php echo $dateTime;?></td>
			</tr>



	      
			    </tbody>
			  </table>
  </div>
	<div class="col-lg-12"  style="margin-bottom: 8%;">
	<h1 style="font-size: 24px !important;margin-bottom: 15px;"><?php echo $profile_last_sms_sent;?>:</h1>
		<table class="table table-striped table-bordered compact" style="width: 100%"  id="myTab">
			    <thead>
			      <tr>				
			        <th><?php echo $group_Id;?></th>			        
			        <th><?php echo $date_time;?></th>		        
			      </tr>
			    </thead>
			    <tbody>
<?php 

$sqlViewsmslog = "SELECT sl.*,EM.ListName FROM sms_log as sl left join EmailListMain as EM on EM.LID=sl.group_id WHERE sl.admin_id= '".$_SESSION['user_id']."' ORDER BY id DESC" ;
//echo $sqlViewEmaillog;die("here");
$resultViewsmslog = mysqli_query($conn,$sqlViewsmslog);
 	
$rowSMS = mysqli_fetch_assoc($resultViewsmslog);
$id      = 	$rowSMS['id'];
$gname   = $rowSMS['ListName'];
$send_date = $rowSMS['send_date'];
$send_time = $rowSMS['send_time'];
$dateTime = $send_date." ".$send_time; 

?>			    




<!--Table-->
			<tr>
			 
			    	<td class="td-width"><?php echo $gname;?></td>
	


			        <td class="td-width"><?php echo $dateTime;?></td>
			</tr>



	      
			    </tbody>
			  </table>
	</div>
    
			  
 </div>
 </div>   			  





</body>

