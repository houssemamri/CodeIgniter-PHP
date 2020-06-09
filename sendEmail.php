<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . 'auth/index');
}
else if($_GET['id']!=$_SESSION['user_id'])
{
  header('Location: ' . 'profile.php?id=' . $_SESSION['user_id']);
}

if(isset($_POST['send'])){
	extract($_POST);
	//print_r($_POST);die("here");
	foreach($emails as $email){
$messagead = $temp_body;
/*$messagead = 'Hi,';
$messagead .= "<br/>";
$messagead .= '<h3>New Customer  Regitration on your site:</h3><br/><br/>';*/
/*$messagead .= " Name: ".$model->patient_name."<br/>";	
$messagead .= "Email: ".$model->email."<br/>";*/

/*$messagead .= "<br/><br/>";
$messagead .= "Regards,<br/>";
$messagead .= "Webmaster Support";*/

//$to1 = "desuntechnology@gmail.com";
//echo $email;
$to1 = $email;

$subjectad = "New Customer registration information";

$headersad = "From: ".'review'." <noreply@theothersong.com>" . "\r\n";
$headersad .= "MIME-Version: 1.0" . "\r\n";
$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headersad .= "X-Mailer: PHP/".phpversion();	
  
   	
  $mail_success = mail($to1,$subjectad,$messagead,$headersad);

if($mail_success){
	echo 'success';
}

	}
}

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
  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

	
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
.select2.select2-container.select2-container--default.select2-container--focus.select2-container--below {
	width: 100% !important;
}
.select2.select2-container.select2-container--default.select2-container--below {
	width: 100% !important; 
}
.select2.select2-container.select2-container--default {
	width: 100% !important;
}
    </style>
  </head>
  <body>
  
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
			<div class="col-md-3"></div>
			<div class="col-md-6">
			<div class="container"><br>
			<form method="post">
			<div class="row">
				<div class="col-md-12">
					<label for="emails">Choose Email ID</label>
					<select class="js-example-basic-multiple" name="emails[]" multiple="multiple">
<?php 
$sql = "SELECT * FROM users";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_object($query);
/*echo "<pre>";
print_r($result);die("here");*/
while($result = mysqli_fetch_object($query)){
?>
						  <option value="<?php echo $result->email;?>"><?php echo $result->email;?></option>
<?php } ;?>						  
					</select>
				</div>
			</div> <br>
				<div class="row">
					<div class="col-md-12">
						 <div class="form-group">
							<label>Choose Template:</label>
							<select name="choose_temp" id="choose_temp" class="form-control">
							<option value="">Select an Option</option>
							<?php
							$sql = "SELECT * FROM add_email";
							$query = mysqli_query($conn,$sql);
							while($result = mysqli_fetch_object($query)){ ?>
								<option value="<?php echo $result->id;?>"><?php echo $result->temp_name;?></option>
							<?php };?>
							</select>
						</div>
					</div>
				</div>	<br>
				<div class="row">
					<div class="col-md-12">
						<textarea name="temp_body" id="template_code" cols="30" rows="10">  </textarea>
					</div>
				</div>
				<button class="btn btn-primary" name="send">send</button>
				</form>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
  <script src="js/select2.min.js"></script>
    
      <script type="text/javascript">
  $(document).ready(function () { 
  
  
  $('#template_code').summernote({
  	height: 300	
  });
   $('.js-example-basic-multiple').select2({
  allowClear: true
});
  /*CKEDITOR.replace( 'template_code' );*/
  
  		$('#choose_temp').on('change',function(){ 			
        var choose_temp = $(this).val();
        //alert(choose_temp);
        if(choose_temp){
            $.ajax({
                type:'POST',
                url:'get_template.php',
                data:'choose_temp='+choose_temp,
                success:function(data){
          	//alert(data);
          	var obj = jQuery.parseJSON(data);
          	//alert(obj.data);
                    $('#template_code').val(obj.data);
                     
                    $("#template_code").summernote(
                            "code",
                            obj.data );
                }
            }); 
				}
			});
  
  	});
  </script>  
    
    <?php include('footer.php');?>
    

    