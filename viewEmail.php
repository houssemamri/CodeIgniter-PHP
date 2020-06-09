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
 <script src="//cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>

	
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
    </style>
  </head>
  <body>
 <?php
 
 /*echo $_GET['id'];die();*/
 
 if(isset($_GET['mode']) && $_GET['mode'] == 'delete')
{
  if(isset($_GET['num']) && $_GET['num'] != "")
  {
	$query_del = "DELETE FROM add_email WHERE id = '".$_GET['num']."' ";
    $qry_del = mysqli_query($conn,$query_del);
  }
header("location:viewEmail.php?id=".$_SESSION['user_id']);
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
		<div class="col-md-3"></div>
		<div class="col-md-6">
			  <table class="table table-responsive table-striped table-hover">
			    <thead>
			      <tr>
			      	<th>Sl. No.</th>
			        <th>Template Name</th>
			        <!--<th>Template Code</th>-->
			        <th>Action</th>
			      </tr>
			    </thead>
			    <tbody>
<?php 
$sql = "SELECT * FROM add_email";
$result = mysqli_query($conn,$sql);

 	$i = 1; 	
while($row = mysqli_fetch_assoc($result)){

$temp_id   = $row['id'];
$temp_name = $row['temp_name'];
/*$temp_code = $row['temp_code'];*/
?>			    
			      <tr>
			      	<td><?php echo $i;?></td>
			        <td><?php echo $temp_name;?></td>
			        <!--<td><?php echo $temp_code;?></td>-->
			        <td><a href="addEmail.php?mode=edit&num=<?php echo $temp_id;?>&id=<?php echo $_SESSION['user_id'];?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
			        <td><a href="javascript:void(0);"  title="Delete" onClick="myJsFunc(<?php echo $temp_id;?>);"><i class="fa fa-trash" aria-hidden="true"></i</a></td>
			      </tr>
	<?php $i++;
	 }; ?>	      
			    </tbody>
		    
			  </table>
		</div>
		<div class="clearfix"></div>
	</div>          
</div>
    
        <?php include('footer.php');?>
        
        <script type="text/javascript">
        	
    function myJsFunc(x){
	   if (confirm("Are you sure that you want to delete the data?"))
	    {
	    window.location.href = "viewEmail.php?mode=delete&num="+x;
	    }
  	} 	
        </script>