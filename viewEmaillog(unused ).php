<?php

session_start();
include_once "connection.php";
include_once "common_function.php";
/*if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . 'auth/index');
}else if($_GET['id']!=$_SESSION['user_id']){
  header('Location: ' . 'profile.php?id=' . $_SESSION['user_id']);
}*/

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>Thunder Review - User Home</title>
    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">
    <link href="css/select2-bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css" media="all">
    <link href="css/responsive-style" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
    <style>
      *
      {
        font-family: 'Raleway', sans-serif;
      }
      h6,.tab-content
      {
        font-family:'Quarca';
      }
      .nav-item>.active
      {
        background-color:#f551a4 !important;
        border-radius: 0 !important;
      }
      .active>h6,.active>span
      {
        color:#fff !important;
      }
      .side
      {
        border-radius: 0 !important;
        border: 1px solid rgba(205, 205, 205,0.25);
      }
	  .network_image {
    height: 40px !important;
}
.networks h3 {
    margin-top: 5px !important;
    font-size: 18px !important;
    padding-left: 14px !important;
}
.networks .panel-heading {
  background:transparent !important;
}

.networks .panel-heading img{
margin-right: 10px !important;
}

.networks .panel-heading h2{
  font-weight: bold !important;
}
.social-accounts .expires {
  background: rgba(0, 0, 0, 0) none repeat scroll 0 0 !important;
  line-height: 43px !important;
  padding-left: 8px !important;
}

.all-networks li {
  display: inline-block;
  min-height: 100% !important;
}
.all-networks li input{
  background: #fff !important;
}
.all-networks .col-md-11{
  width: 100% !important;
}
.all-networks .col-md-1{
  width: 100% !important;
}
.frame1.web_post_iframe {
    height: 500px;
}

/*Modal Style*/

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}


/*Modal Style End*/



    </style>
  </head>
  <body>
 <?php

/*Modal is used to send email after changeing subject and email 
and send is used to resend email without changeing amything*/   
 
 
 //Resend
 if(isset($_POST['send'])){
	extract($_POST);
	//print_r($_POST);
	
	$messagead = $email_body;
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
		$sqlEmailLog = "INSERT INTO emaillog (userid,gid,template_id,email_id,subject,email_body,send_date,send_time) VALUES('".$_SESSION['user_id']."','".$gid."','".$template_id."','".$to1."','".$subject."','".$email_body."','".date('Y-m-d')."','".date('H:i:s')."')";		

		$queryEmailLog = mysqli_query($conn,$sqlEmailLog); 
		if(!$queryEmailLog){
			//echo 'error'.mysqli_error($conn);
			echo '<div style="color:#fff;background:red;width:100%">Error</div>';
		}
	} 
}
	
//After changeing sender name or subject or both

 if(isset($_POST['resend'])){
	extract($_POST);
	//print_r($_POST);
	
	$messagead = $emailBody;
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
		$sqlEmailLog = "INSERT INTO emaillog (userid,gid,template_id,email_id,subject,email_body,send_date,send_time) VALUES('".$_SESSION['user_id']."','".$gid."','".$template_id."','".$to1."','".$name."','".$emailBody."','".date('Y-m-d')."','".date('H:i:s')."')";		

		$queryEmailLog = mysqli_query($conn,$sqlEmailLog); 
		if(!$queryEmailLog){
			//echo 'error'.mysqli_error($conn);
			echo '<div style="color:#fff;background:red;width:100%">Error</div>';
		}
	} 
}


 
 /*echo $_GET['id'];die();*/
 if(isset($_GET['mode']) && $_GET['mode'] == 'delete')
{
  if(isset($_GET['num']) && $_GET['num'] != "")
  {
	$query_del = "delete from emaillog where id ='".$_GET['num']."'and userid=".$_SESSION['user_id'];
    $qry_del = mysqli_query($conn,$query_del);
  }

}
 ?>
      <?php include('navbar.php');?>
      <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/background.jpeg)" data-overlay="8">
      <div class="container text-center">
        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">
            <h1><?php echo $_SESSION['user_name'];?> - <?php echo $profile;?></h1>
            <p class="fs-18 opacity-100" id="subHeader"><?php echo $profileWelcome;?>.</p>
          </div>
        </div>
      </div>
    </header>
    <!-- END Header -->
    <div class="container">
    <div class="row">
    
		<div class="col-md-2"></div><br><br><br>
		<div class="col-md-8">


			  <table class="table table-striped table-bordered table-responsive display compact" id="myTable">
			    <thead>
			      <tr>				
			      	<th><?php echo $slNo;?></th>
			        <th><?php echo $group_Id;?></th>
			        <th><?php echo $email_Id;?></th>
			        <th><?php echo $name;?></th>
			        <!--<th>Content</th>-->
			        <th><?php echo $date_time;?></th>
			        
			        <th>Action</th>
			        <th></th>
			        <th></th>
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
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form action="" method="post">
    	<div class="form-group">
    		<label for="email"><?php echo $email_Id;?></label>
    		<input class="form-control" id="email_id" type="email" name="email_id" id="email" />
    	</div>
    	
    	<div class="form-group">
    		<label for="name"><?php echo $name;?></label>
    		<input class="form-control" type="text" name="name" id="name" />
    	</div>
    	
    	<input type="hidden" name="emailBody" id="emailBody"/>
    	<input type="hidden" name="gid" id="gid" value="<?php echo $gid;?>"/>
    	<input id="template_id" type="hidden" value='<?php echo $template_id;?>' name="template_id"/>	
    	
    	<div class="col-md-6">
    		<button class="btn btn-success btn-xs" name="resend">send</button>	
    			
    		
    </form>
    <button class="btn btn-danger btn-xs" id="close">close</button>
    </div>
  </div>

</div> <!--Modal end-->

<!--Table-->
			      <tr>
			      <form action="" method="post">
			      	<td><?php echo $i;?></td>
			        <td><?php echo $gname;?></td>
			        <input type="hidden" name="gid" value="<?php echo $gid;?>"/>
			        <input type="hidden" name="template_id" value="<?php echo $template_id;?>"/>
			        <td> <input type="hidden" id="email<?php echo $i;?>" value="<?php echo $email_id;?>" name="email"/> <?php echo $email_id;?></td>
			        <td> <input type="hidden" id="subject<?php echo $i;?>" value="<?php echo $subject;?>" name="subject"/> <?php echo $subject;?></td>
			        <td style="display: none;"><input id="email_body<?php echo $i;?>" type="hidden" value='<?php echo $email_body;?>' name="email_body"/></td>

			        <td><?php echo $dateTime;?></td>

			        
			        <td> <button class="btn btn-primary btn-xs"  name="send"><?php echo $send;?></button> </td>
			        </form>
			      <td> <button class="btn btn-danger btn-xs" onclick="myJsFunc(this.value)" value="<?php echo $i;?>"  id="myBtn" name="delete"><?php echo $delete;?></button> </td>
			       
			      <td> <button class="btn btn-primary btn-xs" id="myBtn<?php echo $i;?>"  onclick="resend<?php echo $i;?>()">Change <br> Name & Sender</button></td>
			       
			       <!--<button class="btn btn-primary btn-xs">Change Name</button></td>-->
			        
			        
			        
			        
			      </tr>

 <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn<?php echo $i;?>");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var close = document.getElementById("close");

// When the user clicks the button, open the modal 
function resend<?php echo $i;?>() {
	
  modal.style.display = "block";
 var email = document.getElementById("email<?php echo $i;?>").value;
 var subject = document.getElementById("subject<?php echo $i;?>").value;
 var email_body = document.getElementById("email_body<?php echo $i;?>").value;
 document.getElementById("email_id").value = email;
 document.getElementById("name").value = subject;
 document.getElementById("emailBody").value = email_body;
 
}

 function myJsFunc(x){
 	alert(x);
	   if (confirm("Are you sure that you want to delete the data?"))
	    {
	    window.location.href = "viewEmaillog.php?id=1&mode=delete&num="+x;
	    }
  	}


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks on close, close the modal
close.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>



	<?php $i++;
	 }; ?>	      
			    </tbody>
			  </table>





		</div>
		<div class="col-md-2"></div>
		<div class="clearfix"></div>
	</div>          
</div>
        <?php include('footer.php');?>
 <script type="text/javascript">
    	
  $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>
