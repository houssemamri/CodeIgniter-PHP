<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
include_once 'email/includes/db.class.php';


require  __DIR__ .'/twilio-php-master/Twilio/autoload.php';

$id = $_SESSION['user_id'];

//Getting sms credentials based on curreent user from sms config table
$get_sms_config_details_sql = "SELECT * FROM sms_config WHERE admin_id='".$_SESSION['user_id']."'";
$get_sms_config_details_query = $conn->query($get_sms_config_details_sql);
$results_row=$get_sms_config_details_query->fetch_assoc(); 

//Multiple SMS sending
if(isset($_POST['send'])){
	
	extract($_POST);
	
	
	
 $sid    = $results_row['sid'];
$token  = $results_row['token'];
$client = new Twilio\Rest\Client($sid, $token);

/*echo "<pre>";
print_r($client);die();*/

	for($l=0;$l<count($mob_number);$l++){
		$sqlGroupId = "select * from EmailListSub where LID='".$mob_number[$l]."'";
		/*echo $sqlGroupId;die("here");*/
		$queryGroupId = mysqli_query($conn,$sqlGroupId);
		
   while($result = mysqli_fetch_assoc($queryGroupId)){
   	$sqlEmail="select mobile from EmailList where EID='".$result['EID']."'";
   	//echo $sqlEmail;die("here");
	$query2 = mysqli_query($conn,$sqlEmail);
	$emailName=mysqli_fetch_assoc($query2);
   	//print_r($emailName);die("here");
$mobile = $emailName['mobile'];

$message = $client->messages->create($mobile,array(
                              "from" => $results_row['number'],
                               "body" => $_POST['msg']
                               
                           )
                  );
               

       
   if($message->sid){
   		$sql = "INSERT INTO sms_log( receive_number, group_id , msg, sid, send_time, send_date, owner_sid, from_number, error_message, admin_id) VALUES ('".$message->to."', '".$mob_number[$l]."' ,'".$message->body."','".$message->sid."','".date("H:i:s")."','".date("d-m-y")."','".$message->accountSid."','".$message->from."','".$message->errorMessage."','".$_SESSION['user_id']."')";
   		
   	//	echo $sql;die();
   		
   		$query = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
   		if($query){
			header('Location: https://review-thunder.com/profile.php?id='.$_SESSION['user_id']);
		}
   }   
			
		
	
}

	}           
}

//Modify and sms sending
if(isset($_POST['resendSms'])){
	
	
	
	extract($_POST);
	
	
	
 $sid    = $results_row['sid'];
$token  = $results_row['token'];
$client = new Twilio\Rest\Client($sid, $token);

//print_r($client);



$message = $client->messages->create($_POST['mobile_no'],array(
                              "from" => $results_row['number'],
                               "body" => $_POST['msg']
                               
                           )
                  );

                 

       
   if($message->sid){
   		$sql = "INSERT INTO sms_log( receive_number, group_id , msg, sid, send_time, send_date, owner_sid, from_number, error_message, admin_id) VALUES ('".$message->to."', '".$group_id."' ,'".$message->body."','".$message->sid."','".date("H:i:s")."','".date("d-m-y")."','".$message->accountSid."','".$message->from."','".$message->errorMessage."','".$_SESSION['user_id']."')";
   		
   	//	echo $sql;die();
   		
   		$query = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
   		if($query){
			header('Location: https://review-thunder.com/profile.php?id='.$_SESSION['user_id']);
		}
   }   
	
}

//Same sms sending
if(isset($_POST['sendSameSms'])){
	
	extract($_POST);
	
 $sid    = $results_row['sid'];
$token  = $results_row['token'];
$client = new Twilio\Rest\Client($sid, $token);

//print_r($client);

$message = $client->messages->create($_POST['mobile_no'],array(
                              "from" => $results_row['number'],
                               "body" => $_POST['msg']
                               
                           )
                  );

   if($message->sid){
   		$sql = "INSERT INTO sms_log( receive_number, group_id , msg, sid, send_time, send_date, owner_sid, from_number, error_message, admin_id) VALUES ('".$message->to."', '".$group_id."' ,'".$message->body."','".$message->sid."','".date("H:i:s")."','".date("d-m-y")."','".$message->accountSid."','".$message->from."','".$message->errorMessage."','".$_SESSION['user_id']."')";
   		
   	//	echo $sql;die();
   		
   		$query = mysqli_query($conn,$sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error(), E_USER_ERROR);
   		if($query){
			header('Location: https://review-thunder.com/profile.php?id='.$_SESSION['user_id']);
		}
   }   
	
}

 //SMS DELETE QUERY
 /*echo $_GET['id'];die();*/
 if(isset($_GET['mode']) && $_GET['mode'] == 'delete')
{
  if(isset($_GET['num']) && $_GET['num'] != "")
  {
	$query_del = "DELETE FROM sms_log WHERE id ='".$_GET['num']."' AND admin_id ='".$_SESSION['user_id']."'";
	
	

	//echo $query_del;die();

    $qry_del = mysqli_query($conn,$query_del);
  }
	if($qry_del){
		header('Location: https://review-thunder.com/profile.php?id='.$_SESSION['user_id']);
	}
}

?>

	 <div class="tab-pane fade show <?php echo $main;?>" style="margin: 20px auto;"id="home">
                  <div class="col-lg-12 text-center">
                    
                      <?php
                      include('connection.php');
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
                      $result=$conn->query($sql);
                      $row=$result->fetch_assoc();
?>

				      <div style="text-align: left;">
				      <span id="profileName">   
				      <?php echo $smtphey;?> <span> 
				      <?php echo $row['Name'];?> </span>!<br />
				   <span style="font-size: 18px">   <?php echo $send_sms_greeting;?></span>
				      </span>
				      </div>                  
                  </div>
                </div>

    <div class="container">
		<div class="row">
			<div class="col-md-6">
			<div class="container"><br>
				
				 <form action="" method="post">
				 <div class="row">
                     <style>
                         .avatar-article5{
                             position: relative;
                             left: -230px;
                             top: 137px;
                             width: 120px;
                         }
                         .bubble-article5 > span{
                             position: absolute;
                             top: -120px;
                             left: 90px;
                             width: 130px;
                             font-size: 12px;
                             max-height: 160px;
                             font-weight: 900;
                             line-height: 1.5;
                         }
                         .bubble-article5 > img{
                             position: absolute;
                             top: -190px;
                             left: 45px;
                             max-width: 210px;
                             max-height: 200px;
                             width: 210px;
                             height: 200px;
                         }

                         .avatar-article-img5{
                             position: absolute;
                             top: -20px;
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
                     <div class="avatar-article avatar-article5">
                         <div class="bubble-article5">
                             <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
                             <span><?=$avatarTextSms?></span>
                         </div>
                         <img class="avatar-article-img5" src="avatar/img/avatar/<?=$row['avatar']?>.png">
                     </div>
				 	<div class="col-md-12">
				 		<div class="form-group">
				 	<label for="emails"><?php echo $chooseGroupName;?></label>
					<select class="js-example-basic-multiple_mobile" id="listId" name="mob_number[]" multiple="multiple">

<?php 

$sql = "SELECT * FROM EmailListMain WHERE UID='".$_SESSION['user_id']."'";

$query = mysqli_query($conn,$sql);

while($result = mysqli_fetch_object($query)){

?>

						  <option  value="<?php echo $result->LID;?>"><?php echo $result->ListName;?></option>
<?php } ;?>						  
					</select>
				 		</div>
				 	</div>
				 </div>
				 <div class="row">
				 	<div class="col-md-12">
				 		<div class="form-group">
				 			<label for="msg"><?php echo $send_sms_table_message;?></label>
				 			<textarea class="form-control" name="msg"></textarea>
				 		</div>
				 	</div>
				 </div>
				 <button class="btn btn-primary" name="send"><?php echo $send_sms_button; ?></button>
				 </form>
				
				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	</div>
	
	<br />
	<br />
	<br />
	<br />
		
	
     <div class="container">
    <div class="row">

        <style>
            #smsLogTable2{
                width: 100% !important;
            }
            @media (max-width: 576px) {
                #smsLogTable2{
                    font-size: 50% !important;
                }
            }

        </style>
  

     <table class="table table-striped table-bordered compact dataTable no-footer"  id="smsLogTable2">
			    <thead>
			      <tr>				
			      	<th><?php echo $send_sms_table_mobile;?></th>
			      	<th><?php echo $send_sms_table_group;?></th>
			        <th><?php echo $send_sms_table_message;?></th>
			        <th><?php echo $send_sms_table_send_date;?></th>			        
			        <th><?php echo $send_sms_table_send_time;?></th>
			        <th><?php echo $send_sms_table_action;?></th>
			      </tr>
			    </thead>
			    <tbody>
			
			<?php
		$sql = "SELECT sl.*,EM.ListName FROM sms_log as sl left join EmailListMain as EM on EM.LID=sl.group_id WHERE sl.admin_id='".$_SESSION['user_id']."'";
		$query = mysqli_query($conn, $sql);
		$i = 1; 
		while($row = mysqli_fetch_assoc($query))	 {
		//print_r($row);die();
		?>
		
		
		
		
<!-- The Modal -->
<div id="mySmsModal<?php echo $i;?>" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <!--<span class="close">&times;</span>-->
    <form action="" method="post">
    	<div class="form-group">
    		<label for="mobile">Mobile No</label>
    		<select class="form-control" name="mobile_no" id="email" style="width: 100% !important">
<?
$emailSUBSql = "SELECT EID FROM EmailListSub WHERE LID = '".$row['group_id']."'";
//echo $emailSUBSql;
$emailSUBquery = mysqli_query($conn,$emailSUBSql);
//$row  = mysqli_fetch_assoc($emailSUBquery);
//echo $row['EID'];die();
while($row1  = mysqli_fetch_assoc($emailSUBquery)){
	
	$sqlMobileList = "SELECT Mobile FROM EmailList WHERE EID = '".$row1['EID']."'";
	//echo $sqlEmailList;
	$queryMobileList = mysqli_query($conn,$sqlMobileList);
	while($mobileRow = mysqli_fetch_assoc($queryMobileList)){
		?>
	<option value="<?php echo $mobileRow['Mobile'] ;?>"><?php echo $mobileRow['Mobile'] ;?></option>	
<?php		
	}
	
	
	
}



?>    			

    			
    			
    			
    		</select>
    		<!--<input class="form-control" id="email_id" type="email" name="email_id" id="email" />-->
    	</div>
    	
    	<div class="form-group">
    		<label for="name"><?php echo $send_sms_table_message;?></label>
    		<input class="form-control" type="text" name="msg" id="name" />
    	</div>
    	
    	<!--<input type="hidden" name="emailBody" id="emailBody"/>-->
    	<input type="hidden" name="group_id" id="gid" value="<?php echo $row['group_id'];?>" />
    	<input type="hidden" name="id" id="id"  value="<?php echo $row['id'];?>" />	
    	
    	<div class="col-md-6">
    		<button class="btn btn-success btn-xs" name="resendSms">send</button>	&nbsp;
    		
    			
    </form>
    	<button class="btn btn-danger btn-xs" onclick="closeModal<?php echo $i;?>(<?php echo $i;?>)" id="close<?php echo $i;?>">close</button>
    </div> 	
    </div>		
		


	
		
		
		
		
		
			
		<tr>
		<td><?php echo $row['receive_number'];?></td>
		<td><?php echo $row['ListName'];?></td>
		<form action="" method="post">
			<input type="hidden" name="mobile_no" value="<?php echo $row['receive_number'];?>" />
			<input type="hidden" name="group_id" value="<?php echo $row['group_id'];?>"/>
			<input type="hidden" name="msg" value="<?php echo $row['msg'];?>"/>
		<td style="width: 200px !important;"><?php echo $row['msg'];?></td>
		<td><?php echo $row['send_date'];?></td>
		<td><?php echo $row['send_time'];?></td>
		<td> <button class="btn btn-primary btn-xs circle"  name="sendSameSms"><?php echo $send_sms_button;?></button> 
		
		</form>
		<button class="btn btn-success btn-xs circle" id="myBtn<?php echo $i;?>"  onclick="resendSMS<?php echo $i;?>(<?php echo $i;?>)"><?php echo $modify;?></button>
		<button class="btn btn-danger btn-xs circle" onclick="mysmsJsFunc(this.value)" value="<?php echo $row['id'];?>"  id="myBtn" name="delete"><?php echo $delete;?></button> 			      
			       </td>  
		</tr>
		
		
		
		
<!-- Script For Modal -->
<script>

// When the user clicks the button, open the modal 
function resendSMS<?php echo $i;?>(modalNum) {
	//alert(modalNum);
// Get the modal
var modal = document.getElementById('mySmsModal'+modalNum);

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
//var span = document.getElementsByClassName("close")[0];
var close = document.getElementById("close"+modalNum);
	
  modal.style.display = "block";
 var email = document.getElementById("email<?php echo $i;?>").value;
 var subject = document.getElementById("subject<?php echo $i;?>").value;
 var id = document.getElementById("id<?php echo $i;?>").value;
	//document.getElementById("email_id").value = email;
 document.getElementById("name").value = subject;
 document.getElementById("id").value = id;
 
}

 function mysmsJsFunc(x){
 	//alert(x);
	   if (confirm("Are you sure that you want to delete the data?"))
	    {
	    window.location.href = "sms/send_sms.php?id=<?php echo $_SESSION['user_id'];?>&mode=delete&num="+x;
	    }
  	}

function closeModal<?php echo $i;?>(modalNum){
	//alert('yeah');
var modal = document.getElementById('mySmsModal'+modalNum);
	modal.style.display = "none";
}

// When the user clicks on close, close the modal
/*close+modalNum.onclick = function() {
  modal.style.display = "none";
}*/
var modal = document.getElementById('mySmsModal<?php echo $i;?>');
// When the user clicks anywhere outside of the modal, close it
//window.onclick = function(event) {
//  if (event.target == modal) {
//    modal.style.display = "none";
//  }
//}
</script>			
		
		
		
		
		
		
		<?php 
		$i++;
}
		?>
			
			    </tbody>
			  </table>
			  
 </div>
 </div>  