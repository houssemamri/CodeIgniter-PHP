<?php
define('DEBUG', false);

error_reporting(E_ALL);
ini_set('display_errors', DEBUG ? 'On' : 'Off');
/*session_start();
include_once "connection.php";
include_once "common_function.php";*/
include ("email/config.php");
include("email/includes/db.class.php");
/*if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . 'auth/index');
}else if($_GET['id']!=$_SESSION['user_id']){
  header('Location: ' . 'profile.php?id=' . $_SESSION['user_id']);
}*/

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
  <?php

/*Modal is used to send email after changeing subject and email 
and send is used to resend email without changeing amything*/   
 
 
 //Resend
 if(isset($_POST['send'])){
	extract($_POST);
	//print_r($_POST);die();
	
	$email_bodysql = "SELECT email_body FROM emaillog WHERE id='".$email_body."'";
	$email_bodyquery = mysqli_query($conn,$email_bodysql);
	$row = mysqli_fetch_assoc($email_bodyquery);
	
	
	$messagead = $row['email_body'];
	$to1 = $email;
	$subjectad = $subject;
	$headersad = "From: ".'Review Thunder'." <noreply@review-thunder.com>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();	
  	
    $mail_success = mail($to1,$subjectad,$messagead,$headersad);
	/*if(!$mail_success){
		echo "error";
	}*/	

	if($mail_success){
		//function written in db.class.php in email/includes folder
		$db = new Db();
		$sqlEmailLog = $db->insertEmailLog($_SESSION['user_id'],$gid,$template_id,$to1,$subject,$row['email_body'],date('Y-m-d'),date('H:i:s'));
		
/*		$sqlEmailLog = "INSERT INTO emaillog (userid,gid,template_id,email_id,subject,email_body,send_date,send_time) VALUES('".$_SESSION['user_id']."','".$gid."','".$template_id."','".$to1."','".$subject."','".$email_body."','".date('Y-m-d')."','".date('H:i:s')."')";		

		$queryEmailLog = mysqli_query($conn,$sqlEmailLog); */
		if(!$sqlEmailLog){
			//echo 'error'.mysqli_error($conn);
			echo '<div style="color:#fff;background:red;width:100%">Error</div>';
		}
	} 
}
	
//After changeing sender name or subject or both

 if(isset($_POST['resend'])){
	extract($_POST);
	//print_r($_POST);die();
	
	$email_bodysql = "SELECT * FROM emaillog WHERE id='".$id."'";
	$email_bodyquery = mysqli_query($conn,$email_bodysql);
	$row = mysqli_fetch_assoc($email_bodyquery);
	
	/*print_r($row);die();*/
	
	$messagead = $row['email_body'];
	$to1 = $email_id;
	$subjectad = $name;
	$headersad = "From: ".'Review Thunder'." <noreply@review-thunder.com>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();	
  	
    $mail_success = mail($to1,$subjectad,$messagead,$headersad);
	if(!$mail_success){
		echo "error";
	}

	if($mail_success){
		
		$db = new Db();
		$sqlEmailLog = $db->insertEmailLog($_SESSION['user_id'],$gid,$row['template_id'],$to1,$name,$row['email_body'],date('Y-m-d'),date('H:i:s'));
		
		/*$sqlEmailLog = "INSERT INTO emaillog (userid,gid,template_id,email_id,subject,email_body,send_date,send_time) VALUES('".$_SESSION['user_id']."','".$gid."','".$template_id."','".$to1."','".$name."','".$emailBody."','".date('Y-m-d')."','".date('H:i:s')."')";		

		$queryEmailLog = mysqli_query($conn,$sqlEmailLog); */
		if(!$sqlEmailLog){
			//echo 'error'.mysqli_error($conn);
			echo '<div style="color:#fff;background:red;width:100%">Error</div>';
		}
	} 
}


 //DELETE QUERY
 /*echo $_GET['id'];die();*/
 if(isset($_GET['mode']) && $_GET['mode'] == 'delete')
{
  if(isset($_GET['num']) && $_GET['num'] != "")
  {
	$query_del = "DELETE FROM emaillog WHERE id ='".$_GET['num']."' AND userid='".$_SESSION['user_id']."'";
	
	$db = new Db();
	$conn = $db->connect();

	//echo $query_del;die();

    $qry_del = mysqli_query($conn,$query_del);
  }
	if($qry_del){
		header('Location: https://review-thunder.com/profile.php?id='.$_SESSION['user_id']);
	}
}
 ?>

     <div class="container">
    <div class="row">
    
  
	<div class="col-lg-12" style="text-align: center; margin-bottom: 4%">
		<h1><?php echo $emaillog;?></h1>
	</div>
     <table class="table table-striped table-bordered compact" style="width: 100%"  id="myTable">
			    <thead>
			      <tr>				
			      	<th><?php echo $slNo;?></th>
			        <th><?php echo $group_Id;?></th>
			        <th>Subject</th>			        
			        <th>Template Name</th>
			        <!--<th>Content</th>-->
			        <th><?php echo $date_time;?></th>
			        
			        <th>Action</th>
			      
			      </tr>
			    </thead>
			    <tbody>
<?php 

$sqlViewEmaillog = "SELECT el.*,EM.ListName FROM emaillog as el left join EmailListMain as EM on EM.LID=el.gid WHERE el.userid=".$_SESSION['user_id'];
//echo $sqlViewEmaillog;die("here");
$resultViewEmaillog = mysqli_query($conn,$sqlViewEmaillog);
 	$i = 1; 	
while($row = mysqli_fetch_assoc($resultViewEmaillog)){
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

<!-- The Modal -->
<div id="myEmailModal<?php echo $i;?>" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <!--<span class="close">&times;</span>-->
    <form action="" method="post">
    	<div class="form-group">
    		<label for="email"><?php echo $email_Id;?></label>
    		<select class="form-control" name="email_id" id="email" style="width: 100% !important">
<?
$emailSUBSql = "SELECT EID FROM EmailListSub WHERE LID = '".$gid."'";
$emailSUBquery = mysqli_query($conn,$emailSUBSql);
//$row  = mysqli_fetch_assoc($emailSUBquery);
//echo $row['EID'];die();
while($row  = mysqli_fetch_assoc($emailSUBquery)){
	
	$sqlEmailList = "SELECT Email FROM EmailList WHERE EID = '".$row['EID']."'";
	$queryEmailList = mysqli_query($conn,$sqlEmailList);
	while($emailRow = mysqli_fetch_assoc($queryEmailList)){
		?>
	<option value="<?php echo $emailRow['Email'] ;?>"><?php echo $emailRow['Email'] ;?></option>	
<?php		
	}
	
	
	
}



?>    			

    			
    			
    			
    		</select>
    		<!--<input class="form-control" id="email_id" type="email" name="email_id" id="email" />-->
    	</div>
    	
    	<div class="form-group">
    		<label for="name"><?php echo $name;?></label>
    		<input class="form-control" type="text" name="name" id="name" />
    	</div>
    	
    	<!--<input type="hidden" name="emailBody" id="emailBody"/>-->
    	<input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>" />
    	<input type="hidden" name="id" id="id"  value="<?php echo $id;?>" />	
    	
    	<div class="col-md-6">
    		<button class="btn btn-success btn-xs" name="resend">send</button>	&nbsp;
    		
    			
    </form>
    	<button class="btn btn-danger btn-xs" onclick="closeModal(<?php echo $i;?>)" id="close<?php echo $i;?>">close</button>
    </div> 	
    </div>
  </div><!--Modal end-->


<!--Table-->
			<tr>
			    <form action="" method="post">
			        <td class="td-width"><?php echo $i;?></td>
			    	<td class="td-width"><?php echo $gname;?></td>
			        <input type="hidden" name="gid" value="<?php echo $gid;?>" />
			        <input type="hidden" name="template_id" value="<?php echo $template_id;?>" />
			        <?php //getting template name based on template id
			        $sqlTmpName = "SELECT name FROM templates WHERE id=".$template_id ;
			        		$queryTmpName = mysqli_query($conn,$sqlTmpName);
			        		while($row = mysqli_fetch_assoc($queryTmpName)){
								$tmp_name = $row['name'];
							}
			        ?>
			        <input type="hidden" id="email<?php echo $i;?>" value="<?php echo $email_id;?>" name="email" /> 
			            <td class="td-width"><input type="hidden" id="subject<?php echo $i;?>" value="<?php echo $subject;?>" name="subject" /> <?php echo $subject;?></td>
			        <td class="td-width"><input type="hidden" id="tmp_name<?php echo $i;?>" value="<?php echo $tmp_name;?>" name="template_name" /> <?php echo $tmp_name;?></td>
			        <input id="id<?php echo $i;?>" type="hidden" value='<?php echo $id;?>' name="email_body"/>
			        <td class="td-width"><?php echo $dateTime;?></td>
			        <td> <button class="btn btn-primary btn-xs circle"  name="send">Send</button> 
			        </form>
			        <button class="btn btn-success btn-xs circle" id="myBtn<?php echo $i;?>"  onclick="resendEmail<?php echo $i;?>(<?php echo $i;?>)"><?php echo $modify;?></button>
			     <button class="btn btn-danger btn-xs circle" onclick="myJsFunc(this.value)" value="<?php echo $id;?>"  id="myBtn" name="delete">Delete</button> 			      
			       </td>  
			</tr>


<!-- Script For Modal -->
<script>

// When the user clicks the button, open the modal 
function resendEmail<?php echo $i;?>(modalNum) {
	//alert(modalNum);
// Get the modal
var modal = document.getElementById('myEmailModal'+modalNum);

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

 function myJsFunc(x){
 	//alert(x);
	   if (confirm("Are you sure that you want to delete the data?"))
	    {
	    window.location.href = "viewEmailLog.php?id=<?php echo $_SESSION['user_id'];?>&mode=delete&num="+x;
	    }
  	}

function closeModal(modalNum){
	//alert('yeah');
var modal = document.getElementById('myEmailModal'+modalNum);
	modal.style.display = "none";
}

// When the user clicks on close, close the modal
/*close+modalNum.onclick = function() {
  modal.style.display = "none";
}*/
var modal = document.getElementById('myModal<?php echo $i;?>');
// When the user clicks anywhere outside of the modal, close it
//window.onclick = function(event) {
//  if (event.target == modal) {
//    modal.style.display = "none";
//  }
//}
</script>

	<?php $i++;
	 }; ?>	      
			    </tbody>
			  </table>
			  
 </div>
 </div>   			  





</body>

