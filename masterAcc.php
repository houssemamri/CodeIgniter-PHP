<?php
session_start();
if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . 'auth/index');
}
else if($_GET['id']!=$_SESSION['user_id'])
{
  header('Location: ' . 'masterAcc.php?id=' . $_SESSION['user_id']);
}
include('connection.php');
include_once "common_function.php";
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
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">
    <link href="css/select2-bootstrap.css" rel="stylesheet">
	<link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="assets/css/custom.css" media="all">
 <link href="css/responsive-style" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
		 <link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/style.css" />
	        <link rel="stylesheet" type="text/css" href="CircularContentCarousel/css/jquery.jscrollpane.css" media="all" />

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
select {
    float: left;
    width: 41% !important;
    border: none;
    margin-top: 23px;
}

/*nice Menu*/
.rotate {
    -moz-transition: all .5s linear;
    -webkit-transition: all .5s linear;
    transition: all .5s linear;
}
.rotate.down {
    -moz-transform:rotate(90deg);
    -webkit-transform:rotate(90deg);
    transform:rotate(90deg);
}
a {
  text-decoration: none;
}
:after, :before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
/*common*/

.pad-15 {
  padding: 15px;
}

.clear {
  clear: both; 
}
.clear:after, .clear:before{ 
    content: " ";
   display: table;
}
a.toggle-nav {
    top: 12px;
    right: 15px;
    position: absolute;
    color: #fff;
    line-height: 25px;
    font-size: 22px;
    background: #DE5939;
    padding: 3px 5px;
    border-radius: 1px;
    transform: rotate(90deg);
}
.nice-nav {
  width: 250px;
  height: 100%;
  transition:all 0.4s ease-in-out 0s;
  float:left;
  font-size: 15px;
}
.nice-nav li.child-menu span.toggle-right {
    /*background: #fff none repeat scroll 0 0;*/
    bottom: 0;
    display: inline-block;
    float: right;
    padding: 15px;
    position: absolute;
    right: 0;
    text-align: right;
    top: 3px;
}

.nice-nav ul li a {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #f6f6f6;
    color: #333;
    display: block;
    padding: 12px;
    position: relative;
}

.nice-nav ul li.child-menu ul {
  background: #fff;
  display: none;
}

.nice-nav ul li.child-menu ul li a {
  background: #f6f6f6;
  padding: 10px 20px;
}
.nice-nav > ul {
    margin: 0;
    padding: 0;
}
.nice-nav > ul li{
	list-style: none;
	margin: 2px auto;
}
.nice-nav ul li ul {
    padding: 0;
}
.modal-backdrop.fade.show{
	display: none;
}
/*nice Menu*/
input{
	border-radius: 8px !important;
}
        .form-group input{
			    border: 1px solid #b5b9bf !important;
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
.form-control{
	width: 100% !important;
} 
select#choose_temp{
	margin-top: 0;
	border-color: #616771 !important;
}   
.select2-container--default .select2-selection--multiple{
	border-color: #616771 !important;
}
input.form-control.subject{
	    border-radius: 2px !important; 
}
.tem_name{
	    position: relative;
    top: -81px;
    color: white;
	
}

/*OLD STYLE BELOW NEW ADDED STYLES ABOVE IN CASE ANYTHING HAPPEN DELETE ABOVE STYLING BEFORE THAT EVERYTHING JUST WORKING FINE*/
    
    
    
      .card
      {
        height:200px !important;
        background-color: transparent !important

      }
      .active
      {
        height:200px !important;
        background-color: transparent !important
      }
      .fa
      {
        cursor: pointer;
      }
    </style>
  </head>

  <body>

    <?php include('navbar.php');?>
    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
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



    <!-- Main container -->
    <main class="main-content">
    
    
    <section class="section" id="section-vtab">
        <div class="container-fluid">

          <div class="row gap-5">
            <?php
              if(isset($_GET['status']))
              {?>
                <script>
                  alert("Successfully changed accounts!");
                </script>
              <?php
              }
              if(!isset($_GET['type']))
              {
                $main="active";
              }
              else
              {
                $main="";
                if($_GET['type']==1)
                {
                  $list="show active";
                  $mail="";
                }
                else
                {
                  $list="";
                  $mail="show active";
                }
              }
             ?>

            <div class="col-12 col-md-3">
            
              <!--nice menu-->
             <div class="nice-nav">
              <ul>
                <li>
			      <a href="#home" class="linkk" data-toggle="tab" class="<?php echo $main;?>"><?php echo $adminHome;?></a>
			    </li>
			    <li>
			     <!-- <a href="masterAcc.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $manageAcc;?></a>-->
			      <a href="#masterAcc" class="linkk" data-toggle="tab"><?php echo $manageAcc;?></a>
			    </li>
			    <li class="child-menu">
			      <a href="#" class="anchor-tag"><span><?php echo $article;?></span> <span class="fa fa-angle-right rotate toggle-right"></span>
			      </a>
			      <ul class="child-menu">
			      	<li>
			          <a href="article.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $answerReview;?></a>
			        </li>
			        <li>
			          <a href="#" class="anchor-tag"><?php echo $database;?><span class="fa fa-angle-right rotate toggle-right"></span></a>
				          <ul class="child-menu-ul">
				          	<li>
			     			  <a href="upload.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $add;?></a>
			   				</li>
					        <li>
			     			 <a href="update.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $update;?></a>
			    			</li>
				          </ul>
			        </li>
			        <li>
			          <a href="#" class="anchor-tag"><?php echo $preference;?><span class="fa fa-angle-right rotate toggle-right"></span></a>
			            <ul class="child-menu-ul">
					        <li>
			     			  <a href="#link" class="linkk" data-toggle="tab"><?php echo $editLinks;?></a>
			   				</li>
					        <li>
			     			 <a href="#userprefer" class="linkk" data-toggle="tab"><?php echo $userPrefer;?></a>
			    			</li>
							<li>
					          <a href="#accountPreference" class="linkk" data-toggle="tab"><?php echo $accountPreferences;?></a>
					        </li>
			            </ul>
			        </li>
			      </ul>
			    </li>
			    <li class="child-menu">
			        <a href="#" class="anchor-tag"><?php echo $increaseReviews;?><span class="fa fa-angle-right rotate toggle-right"></span></a>				
			         <ul class="child-menu">
			        	<li>
					        <a href="#contactList" class="linkk" ><?php echo $contactList;?></a>
					        
					    </li>
					    <li>
			      	  <a href="#managelist" class="linkk"  data-toggle="tab"><?php echo $manageEmailList;?></a>
			    	</li>
			         	<li >
			      <a href="#" class="anchor-tag"><span><?php echo $emailing;?></span> <span class="fa fa-angle-right rotate toggle-right"></span>
			      </a>
			      <ul class="child-menu-ul">
			        <li>
			          <a data-toggle="tab" class="linkk" href="#addEmail"><?php echo $addEmail;?></a>
			        </li>
					<li>
			          <a data-toggle="tab" class="linkk" href="#sendMail"><?php echo $sendEmails;?></a>
			        </li>
			        
			        <li>
			          <a data-toggle="tab" class="linkk" href="#email_log"><?php echo $viewEmailLog;?></a>
			        </li>
					<li>
			          <a data-toggle="tab" class="linkk" href="#smtpprefer"><?php echo $smtpPrefer;?></a>
			        </li>
			        <li>
			     	 <a href="#selectTemplate" class="linkk" data-toggle="tab">Select Templates</a>
			    	</li>
			      </ul>
			    </li>
					    <li>
			        <a href="manageVideos.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $videoReviews;?></a>
			    </li>
				    	<li>
			      <a href="#qrcode_gent" class="linkk" data-toggle="tab"><?php echo $qrcode;?></a>
			    </li>
				<li >
					<a href="#" class="anchor-tag"><span><?php echo $sms;?></span><span class="fa fa-angle-right rotate toggle-right"></span></a>				
				<ul class="child-menu-ul">
			        <li>
			          <a data-toggle="tab" class="linkk" href="#sendSms">Send SMS</a>
			        </li>
					<li>
			          <a data-toggle="tab" class="linkk" href="#smsLog">SMS Log</a>
			        </li>
			      </ul>
				</li>
			         </ul>
			    </li>
			    
				 <!--<li class="child-menu">
			      <a href="#" class="anchor-tag"><span><?php echo $promoteReviews;?></span> <span class="fa fa-angle-right rotate toggle-right"></span>
			      </a>
			      <ul class="child-menu">
			        <li>
			     	 <a href="#posts_div" class="linkk" data-toggle="tab" onclick="get_content('posts','posts_div')"><?php echo $Posts;?></a>
			    	</li>
					<li>
			      	  <a href="#networks_div" class="linkk" data-toggle="tab" onclick="get_content('networks','networks_div')"><?php echo $networks;?></a>
			   		</li>
			        <li>
			      <a href="#tools_div" class="linkk" data-toggle="tab" onclick="get_content('tools','tools_div')"><?php echo $tools;?></a>
			    </li>
			      </ul>
			    </li>-->
			    <li>
			      <a href="#todo" class="linkk" data-toggle="tab"><?php echo $todoName;?></a>
			    </li>
				
			    <li>
			      <a href="#profile" class="linkk" data-toggle="tab"><?php echo $userPrefer;?></a>
			    </li>
			     
			    
			    <!--<li>
			      <a href="#mybusiness" data-toggle="tab"><?php echo $my_business_account;?></a>
			    </li>-->
			  <!--  <li>
			      <a href="#mail" data-toggle="tab"><?php echo $sendEmails;?></a>
			    </li>-->
			    <!--<li>
			      <a href="#managemail" class="linkk" data-toggle="tab"><?php echo $manageEmail;?></a>
			    </li>-->
			    
			    
			    
			    
			    
			    
			   <!-- <li>
			      <a href="#settings_div" data-toggle="tab" onclick="get_content('settings','settings_div')" ><?php echo $Settings;?></a>
			    </li>-->
			    
			    <!--<li>
			      <a href="#facebook_gent" data-toggle="tab">Facebook</a>
			    </li>-->
				
			  </ul>
             </div>
            <!--nice menu-->
            
            
            <div class="clear"></div>
           
            </div>


            <div class="col-12 col-md-9 align-self-center">
              <div class="tab-content">
                <div class="tab-pane fade show <?php echo $main;?>" id="home">
                  <div class="col-lg-12 text-center">
                    
                        
    			<div class="container">
    			<div class="row">
    			<div class="col-lg-3"></div>
                  <div class="col-lg-9 ">
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
                      Dear <span><?php
                      echo $row['Name'];?></span>
                      <br />
                      <span style="font-size: 20px;">Here are your Accounts ! For Any advices to Manage Them, Please Contact Us!</span> 
                      </span>
                  </div>
                  </div>
                  </div>
             
                  <br /><br />
            
      <?php
      $sql="SELECT * FROM Master WHERE MasterID=" . $_SESSION['master_id'];
      
      $result=$conn->query($sql);
      //print_r($result);die("result");
     
      $count=0;
       ?>
      <section class="section bg-gray">
      <div class="container">
        <div class="row gap-y">
          <?php
            if($result->num_rows>0)
            {
              while($row=$result->fetch_assoc())
              {
               
               
                $sql="SELECT * FROM userImage WHERE UID=" . $row['SubID'];
                $result1=$conn->query($sql);
                $row1=$result1->fetch_assoc();
               	
               	// print_r($row1);
                ?>
                
                 <div class="col-12 col-md-3 col-lg-3">
                   <div class="card card-hover-shadow">
                     <div class="card-block text-center <?php if($row['SubID']==$_GET['id']){?> active <?php }?>">
                        <a href="changeUser.php?id=<?php echo $row['SubID'];?>"><img src="<?php echo $row1['imagePath'];?>" height="150" width="125"/></a>
                          <?php
                             if($count>0 && $row['SubID']!=$_GET['id'])
                             {?>
                               <span class="pull-right" onclick="deleteCompany('<?php echo $row['SubID'];?>');"><i class="fa fa-times"></i></span>
                             <?php
                             }
                          ?>
                     </div>
                   </div>
                 </div>
              <?php
                $count++;
              }
            } 

   	
   
    	            if($result->num_rows < $row['total_ac'])
            {
           ?>
                <div class="col-12 col-md-3 col-lg-3">
                  <div class="card card-hover-shadow">
                    <div class="card-block text-center">
                        <a data-toggle="modal" data-target="#exampleModal"><i class="fa fa-4x fa-plus"></i></a>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $addNewCompany;?></h5>
                        <button type="button" class="close" onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center" style="color:#000 !important;">
                          <label for="company"><?php echo $company;?>: </label> <input type="text" name="company" id="company" value=""/>
                          <br /><br />
                          <div id="success-add" style="font-weight:bold;display:none;"><?php echo $successAdd;?></div>
                          <br /><br />
                          <button type="button" class="btn btn-primary" onclick="addCompany();"><?php echo $addbtn;?></button>
                          <br /><br />
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="location.reload();" data-dismiss="modal"><?php echo $clsbtn;?></button>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
             
              else{ ?>
              
              <div class="col-12 col-md-3 col-lg-3">
                  <div class="card card-hover-shadow">
                    <div class="card-block text-center">
                        <a data-toggle="modal" data-target="#contactModal"><i class="fa fa-4x fa-plus"></i></a>
                    </div>
                  </div>
                </div>
               <!-- Modal -->
                <div class="modal fade" id="contactModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <!--<div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel">Maximum Amount Reached</h5>
                        <button type="button" class="close" onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>-->
                      <button type="button" class="close"  onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="float: right">&times;</span>
                        </button>
                      <div class="modal-body text-center" style="color:#000 !important;">
                          <p>You Have Reached The Maximum Number Of User Contact Us If You Want To Add More User</p>
                          <a class="btn btn-primary" href="https://review-thunder.com/contact.php">Contact Us</a>
                      </div>
               <!--       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="location.reload();" data-dismiss="modal"><?php echo $clsbtn;?></button>-->
                      </div>
                    </div>
                  </div>
                </div>
              
<?php } 


 ?>
        </div>



      </div>
</div>
</div>
</div>
</div>
</div>

    </section>
                    
                    
                    
                    
                  </div>
                </div>
<div class="tab-pane fade" id="mybusiness">


				<?php include('mybusiness.php'); ?>
				</div>
<!--<div class="tab-pane fade" id="newsletter">


				<?php include('loadnewsletter.php'); ?>
				</div>-->
                <div class="tab-pane fade text-center" id="profile">
                  <?php include('editProfile.php');?>
                </div>

                <div class="tab-pane fade text-center" id="link">
                  <?php include('profileHome.php'); ?>
                </div>
				<div class="tab-pane fade text-center" id="masterAcc">
                  
                  <?php include('masterAccount.php');?>
                </div>
                <div class="tab-pane fade" id="mail">
                  <?php include('multiMail.php'); ?>
                </div>

                <div class="tab-pane fade text-center  <?php echo $mail;?>" id="contactList">
                  <?php include('contactList.php'); ?>
                </div>

                <div class="tab-pane fade text-center  <?php echo $list;?>" id="managelist">
                  <?php include('manageList.php'); ?>
                </div>

                <div class="tab-pane fade text-center" id="userprefer">
                  <?php include('managePrefer.php'); ?>
                </div>

                <div class="tab-pane fade text-center" id="todo">
                  <?php include('todoList.php'); ?>
                </div>
				<div class="tab-pane fade" id="posts_div">
                  
                </div> 
				<div class="tab-pane fade" id="tools_div">
                  
                </div>
				 <div class="tab-pane fade" id="networks_div">
                  
                </div>
				 <div class="tab-pane fade" id="bots_div">
                  
                </div>
				  <div class="tab-pane fade" id="settings_div">
                  
                </div>
				 <div class="tab-pane fade" id="qrcode_gent">
                     <?php include('qrcode/index.php'); ?>
                </div>
				<div class="tab-pane fade" id="facebook_gent">
                     <?php include('facebook_setting.php'); ?>
                </div>
				<div class="tab-pane fade" id="email_log">
                     <?php include('viewEmailLog.php'); ?>
                </div>
                <div class="tab-pane fade" id="addEmail">
                     <?php include('addEmailIframe.php'); ?>
                </div>
                <div class="tab-pane fade" id="sendMail">
                     <?php include('sendMail.php'); ?>
                </div>
                <div class="tab-pane fade" id="sendSms">
                     <?php include('sms/send_sms.php'); ?>
                </div>
                <div class="tab-pane fade" id="smsLog">
                     <?php include('sms/sms_log.php'); ?>
                </div>
                <div class="tab-pane fade text-center" id="smtpprefer">
                  <?php include('smtpPrefer.php'); ?>
                </div>
                <div class="tab-pane fade text-center" id="accountPreference">
                  <?php include('accountPreference.php'); ?>
                </div>
                <div class="tab-pane fade text-center" id="selectTemplate">
                  <?php include('select_templates.php'); ?>
                </div>
               <!-- <div class="tab-pane fade" id="email_add">
                <iframe src="https://review-thunder.com/" ></iframe>
                     
                </div>-->
              </div>
            </div>


          </div>


        </div>
      </section>
    
    
    
    
    
    
    
    
    
    <!--
    Master account-->
    


    </main>
    <!-- END Main container -->


    <?php include('footer.php');?>



    <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


<!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script src="js/select2.min.js"></script>
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/select2.min.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
    	 var $k = jQuery.noConflict();
    	   //DataTable
    $k('#myTable').DataTable( {
        "pagingType": "full_numbers"
    } );
//DataTable
    $k('#smsLogTable').DataTable( {
        "pagingType": "full_numbers"
    } );
    //DataTable
    $k('#smsLogTable2').DataTable( {
        "pagingType": "full_numbers"
    } );
    //Nav Menu Tab Function 
$k('.nice-nav .linkk').click(function (evt) {
  evt.preventDefault();
  $k(this).tab('show');
});

$k('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  //new tab
  console.log(e.target);
  
  //previous tab
  console.log(e.relatedTarget);
})
    </script>
	        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	        
 		<script type="text/javascript" src="CircularContentCarousel/js/jquery.easing.1.3.js"></script>
		<!-- the jScrollPane script -->
		<script type="text/javascript" src="CircularContentCarousel/js/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="CircularContentCarousel/js/jquery.contentcarousel.js"></script>   
    <script type="text/javascript">
    	 var $j = jQuery.noConflict();
    	    $j('#ca-container').contentcarousel();
    </script>
       <script>
    
 function addCompany()
        {
          var c=$('#company').val();
          jQuery.ajax({
            type: "POST",
            url: "addMaster.php",
            data: {company:c},
            success: function(response){
              $('#company').val('');
              $('#success-add').css('display','block');
            }
          });
        }
        function deleteCompany(e)
        {
          var r=confirm("Do you really want to delete your company?");
          if(r==true)
          {
              jQuery.ajax({
                type: "POST",
                url: "deleteMaster.php",
                data: {company:e},
                success: function(response){
                  alert("Successfully deleted company!");
                  location.reload();
                }
              });
          }
        }
    
//changeing send button test and email    
document.getElementById("testEmailSend").addEventListener("click", testEmailFunction);
function testEmailFunction(){
	document.getElementById("emailGroup").style.display = "none";
	document.getElementById("send").style.display = "none";
	document.getElementById("testEmailSend").style.display = "none";
	document.getElementById("testInputEmail").style.display = 'block';
	document.getElementById("sendEmail").style.display = 'block';
}
document.getElementById("scheduleEmail").addEventListener("click", scheduleEmail);
function scheduleEmail(){
	
	document.getElementById("emailGroup").style.display = "block";
	document.getElementById("scheduleEmailSend").style.display = "block";
	document.getElementById("schedule_date").style.display = 'block';
	document.getElementById("schdeule_time").style.display = 'block';
	document.getElementById("send").style.display = "none";
	document.getElementById("testEmailSend").style.display = "none";
	document.getElementById("testInputEmail").style.display = 'none';
	document.getElementById("sendEmail").style.display = 'none';
	document.getElementById("scheduleEmail").style.display = 'none';	
}
//for sending mail
 function myFunction(){
		  var emailBody = document.querySelector(".content-main").innerHTML;
  		 document.getElementById("contentBody").value = emailBody ;
	}


//Select Input
	$('.js-example-basic-multiple').select2({
  allowClear: true
});

//Select Input
	$('.js-example-basic-multiple_mobile').select2({
  allowClear: true
});

//Date Picker
 $('#sch_date').datetimepicker({
      format: 'LT'
 });

	
	
  function iframeLoaded() {
      var iFrameID = document.getElementById('myLethe');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }

	
        $(".multipleSelect").select2({
          tags: true
        })
        function chooseEmail()
        {
          var opt=document.getElementById('selectText');
          //alert(opt.options[opt.selectedIndex].text);
          var str = opt.options[opt.selectedIndex];
          if(str.value==0)
          {
              document.getElementById('updateMail').value = "";
          }
          else
          {
            document.getElementById('updateMail').value = str.text;
          }

        }
		 function updateUserFB(tabletype)
        {
            var id=document.getElementById('user_id').value;
            var fb_link=document.getElementById('fb_link').value;
            var fb_app_id=document.getElementById('fb_app_id').value;
            var fb_app_id=document.getElementById('fb_app_id').value;
            var fb_app_id=document.getElementById('fb_app_id').value;
            var fb_app_secret=document.getElementById('fb_app_secret').value;
            var fb_page_id=document.getElementById('fb_page_id').value;
            
            jQuery.ajax({
             type: "POST",
             url: "updateFb.php",
             data: {user_id:id,fb_link:fb_link,fb_app_id:fb_app_id,fb_page_id:fb_page_id,fb_app_secret:fb_app_secret,tabletype:tabletype},
             success: function(response){
                window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
             }
             });
        }
        function addList()
        {
          var checkboxes = document.getElementsByClassName('emaillist');
          var count = 0;
          for (var i=0, n=checkboxes.length;i<n;i++)
          {
              if (checkboxes[i].checked)
              {
                  count++;
              }
          }
          if(count==0)
            alert("<?php echo $atLeastOne;?>");
          else
          {
            var e=[];
            $("input[class='emaillist']:checked").each(function(){
              e.push(this.value);
            });
            var l=$('#listName').val();
            jQuery.ajax({
              type: "POST",
              url: "addList.php",
              data: {lid:l,emails:e},
              success: function(response){
                location.href='<?php echo base_url2();?>profile.php?id=2&type=2';
              }
            });
          }
        }
        function updateList(id)
        {
          var checkboxes = document.getElementsByClassName('emaillist');
          var count = 0;
          for (var i=0, n=checkboxes.length;i<n;i++)
          {
              if (checkboxes[i].checked)
              {
                  count++;
              }
          }
          if(count==0)
            alert("Please select at least one Email");
          else
          {
            var e=[];
            $("input[class='emaillist']:checked").each(function(){
              e.push(this.value);
            });
            jQuery.ajax({
              type: "POST",
              url: "updateList.php",
              data: {lid:id,emails:e},
              success: function(response){
                location.href='<?php echo base_url2();?>profile.php?id=2&type=2';
              }
            });
          }

        }
        function updateTable()
        {
          var id=document.getElementById('UID').value;
         var s=document.getElementById('SMTP').value;
         var suser=document.getElementById('SMTPuser').value;
         var spwd=document.getElementById('SMTPpwd').value;
         jQuery.ajax({
          type: "POST",
          url: "updateProfile.php",
          data: {uid:id,smtp:s,user:suser,pwd:spwd},
          success: function(response){
             window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
          }
          });
        }
        function updateUser()
        {
            var id=document.getElementById('UID').value;
            var n=document.getElementById('Name').value;
            var c=document.getElementById('Company').value;
            var p=document.getElementById('Position').value;
            var e=document.getElementById('Email').value;
            var ct=document.getElementById('Contact').value;
            jQuery.ajax({
             type: "POST",
             url: "updateDetails.php",
             data: {uid:id,name:n,company:c,position:p,email:e,contact:ct},
             success: function(response){
                window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
             }
             });
        }
        function changePassword()
            {
              var id=document.getElementById('UID').value;
              var p=document.getElementById('pwd').value;
              //alert(u + " "+  p);
              jQuery.ajax({
               type: "POST",
               url: "changePassword.php",
               data: {uid:id,pwd:p},
               success: function(response){
                  window.location.href = "<?php echo $_SERVER['REQUEST_URI'];?>";
               }
               });
            }
        function addMail()
        {
          var m=document.getElementById('newMail').value;
          var f=document.getElementById('firstName').value;
          var l=document.getElementById('lastName').value;
          var c=document.getElementById('companyName').value;
          var p=document.getElementById('mobile').value;
          var u='<?php echo $_GET['id'];?>';
          jQuery.ajax({
            type: "POST",
            url: "addMultiMail.php",
            data: {
              uid:u,
              mail:m,
              first:f,
              last:l,
              company:c, 
              mobile: p
            },
            success: function(response){
              console.log(response);
              if (response === 'true') {
                $('#newMail').val('');
                $('#firstName').val('');
                $('#lastName').val('');
                $('#companyName').val('');
                $('#mobile').val('');
              }
            }
          });
        }
        function sendEmail(id)
        {
          var t=$('#tempName'+id).val();
          var e=$('#hiddenid'+id).val();
          var s=$('#subject'+id).val();
          var m=$('#email'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "sendEmaill.php",
            data: {eid:e,tempName: t,subject: s, email: m},
            success: function(response){
            	
              window.location.reload();
            }
          });
        }
        function updateTempName(id)
        {
          var t=$('#tempName'+id).val();
          var e=$('#hiddenid'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "updateTemplateName.php",
            data: {eid:e,tempName: t},
            success: function(response){
            	
              window.location.reload();
            }
          });
        }
         function updateEmail(id)
        {
          var m=$('#updateMail'+id).val();
          var e=$('#hiddenEid'+id).val();
          var f=$('#firstName'+id).val();
          var l=$('#lastName'+id).val();
          var c=$('#company'+id).val();
          var p=$('#mobile'+id).val();
          var s=$('#service'+id).val();
          var co=$('#comment'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "updateMultiMail.php",
            data: {eid:e,mail:m,first:f,last:l,company:c, mobile: p, service: s, comment: co},
            success: function(response){
            	
              window.location.reload();
            }
          });
        }
        function deleteEmail(id)
        {
          var opt=document.getElementById('deleteMail');
          var e=id;
          var r = confirm("<?php echo $confirm;?>");
          if(r==true)
          {
              jQuery.ajax({
                type: "POST",
                url: "deleteMultiMail.php",
                data: {eid:e},
                success: function(response){
                  window.location.reload();
                }
              });
          }
        }
        function deleteLists(id)
        {
          var l=id;
          var r = confirm("Confirm Delete?");
          if(r==true)
          {
              jQuery.ajax({
                type: "POST",
                url: "deleteList.php",
                data: {lid:l},
                success: function(response){
                  window.location.reload();
                }
              });
          }
        }
        function updatePreference(e)
        {
          var t1,t2,t3,t4;
          if(e==1)
          {
            t1=$('#s1').val();
            t2=$('#s2').val();
            t3=$('#s3').val();
            t4=$('#s4').val();
          }
          else if(e==2)
          {
            t1=$('#s5').val();
            t2=$('#s6').val();
            t3=$('#s7').val();
            t4=$('#s8').val();
          }
          else
          {
            t1=$('#s9').val();
            t2=$('#s10').val();
            t3=$('#s11').val();
            t4=$('#s12').val();
          }
          jQuery.ajax({
            type: "POST",
            url: "updatePreference.php",
            data: {opt:e,s1:t1,s2:t2,s3:t3,s4:t4},
            success: function(response){
              window.location.reload();
            }
          });
        }
        function addToDo()
        {
          var i=document.getElementById('todoitem').value;
          var u='<?php echo $_GET['id'];?>';
          var d=document.getElementById('tododueDate').value;
          var c=document.getElementById('todocomment').value;
          
          jQuery.ajax({
            type: "POST",
            url: "addItem.php",
            data: {uid:u,item:i, date: d, comment: c},
            success: function(response){
              $('#todoitem').val('');
              $('#tododueDate').val('');
              $('#todocomment').val('');
            }
          });
        }
        function updateTodo(id)
        {
          var i=$('#updateItem'+id).val();
          var t=$('#hiddenTid'+id).val();
          var d=$('#updateItemDueDate'+id).val();
          var c=$('#updateItemComment'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "updateItem.php",
            data: {tid:t,item:i, Date: d, Comment:c},
            success: function(response){
              window.location.reload();
            }
          });
        }
        function deleteTodo(id)
        {
          var t=id;
          var r = confirm("Confirm Delete?");
          if(r==true)
          {
              jQuery.ajax({
                type: "POST",
                url: "deleteItem.php",
                data: {tid:t},
                success: function(response){
                  window.location.reload();
                }
              });
          }
        }
        function checkTodo(id)
        {
          jQuery.ajax({
            type: "POST",
            url: "checkItem.php",
            data: {tid:id},
            success: function(response){
              var $checkedRows = $("#Item"+id);
              $checkedRows.detach().clone().appendTo('#mytable2');
              $("#Item"+id+" input[type='checkbox']").attr("disabled", true);
              return false;
            }
          });
        }
        function uncheckTodo(id)
        {
          jQuery.ajax({
            type: "POST",
            url: "uncheckItem.php",
            data: {tid:id},
            success: function(response){
              $('#default').remove();
              var $checkedRows = $("#addItem"+id).prop("checked",true);
              $checkedRows.detach().clone().appendTo('#mytable1');
              $("#addItem"+id+" input[type='checkbox']")/*.attr("read", true)*/;
              return false;
            }
          });
        }
		function show_localPost_Fields(tab)
{
	if (tab == 1){
	jQuery("#localpost_topictype").val('STANDARD');
	document.getElementById("post_detail_localpost").placeholder = "Write Your Post";
    document.getElementById('localpost_title').style.display = 'none';
    document.getElementById('post_date_time_locahost').style.display = 'none';
	document.getElementById('localpost_calltoaction').style.display = 'block';
	document.getElementById('localpost_post_url').style.display = 'block';
	document.getElementById('localpost_coupon_code').style.display = 'none';
	document.getElementById('localpost_offer_link').style.display = 'none';
	document.getElementById('localpost_offer_term_condition').style.display = 'none';
	
				}
				if (tab == 2){
					jQuery("#localpost_topictype").val('EVENT');
	document.getElementById('post_detail_localpost').placeholder = "Event Details";
	document.getElementById('post_title_localpost').placeholder = "Title of the event";
	jQuery('#post_text_localpost').text("(Example: Promotions this week)");
    document.getElementById('localpost_title').style.display = 'block';
    document.getElementById('post_date_time_locahost').style.display = 'block';
	document.getElementById('localpost_calltoaction').style.display = 'block';
	document.getElementById('localpost_post_url').style.display = 'block';
	document.getElementById('localpost_coupon_code').style.display = 'none';
	document.getElementById('localpost_offer_link').style.display = 'none';
	document.getElementById('localpost_offer_term_condition').style.display = 'none';
				}
				if (tab == 3){
					jQuery("#localpost_topictype").val('OFFER');
	document.getElementById('post_detail_localpost').placeholder = "Offer Details";
	document.getElementById('post_title_localpost').placeholder = "Title of the offer";
	jQuery('#post_text_localpost').text("(Example:20% discount in store or online)");
    document.getElementById('localpost_title').style.display = 'block';
    document.getElementById('post_date_time_locahost').style.display = 'block';
    document.getElementById('localpost_coupon_code').style.display = 'block';
    document.getElementById('localpost_offer_link').style.display = 'block';
    document.getElementById('localpost_offer_term_condition').style.display = 'block';
    document.getElementById('localpost_calltoaction').style.display = 'none';
    document.getElementById('localpost_post_url').style.display = 'none';
	
				}
}
    </script>
	
	<script>

function get_content(link,divs){
	
	/* if(user==1){
		url='admin/network/'+link;
		
	}else{
		url='user/network/'+link;
		
		
	} */
	var url='user/'+link;
    $.ajax({
           type: "GET",
           url: url,
           success: function(data)
           {
			   $("#"+divs).html(data);

           }
         }); 
	
}
function get_content_menu(link,divs){
	
	
    $.ajax({
           type: "GET",
           url: link,
           success: function(data)
           {
			   $("#"+divs).html(data);

           }
         }); 
	
}


function logout_google(){

	var url = "user_google.php?logout"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#submit_google").serialize(), // serializes the form's elements.
           success: function(data)
           {
			  location.reload();

           }
         });


}
jQuery("#submit_google").submit(function(e) {


    var url = "user_google.php"; // the script where you handle the form input.

    $.ajax({
           type: "POST",
           url: url,
           data: $("#submit_google").serialize(), // serializes the form's elements.
           success: function(data)
           {
              $('#google_div').html(data);

			  // alert(); // show response from the php script.
           }
         });

   // e.preventDefault(); // avoid to execute the actual submit of the form.
});
//jQuery(".nav-link").click(function(){
//	var href=$(this).attr('href');
//	var myString = href.replace("#",'');
//	var link_tab=jQuery.trim(myString);
//if(link_tab!="posts_div" || link_tab!="tools_div" ||link_tab!="networks_div" ||link_tab!="bots_div"  ){
//		jQuery("#posts_div").html('');
//		jQuery("#tools_div").html('');
//		jQuery("#networks_div").html('');
//		jQuery("#bots_div").html('');
//
//	}
//});


function cancel_btn() {
        $('.modal').hide();

    }
	
/*nice menu*/
$(document).ready(function() {
   //menu left toggle

   //drop down menu
   $submenu = $('.child-menu-ul');
   $('.anchor-tag').on('click', function(e) {
     e.preventDefault();
     $this = $(this);
     $parent = $this.next();
     $tar = $('.child-menu-ul');
     if (!$parent.hasClass('active')) {
       $tar.removeClass('active').slideUp('fast');
       $parent.addClass('active').slideDown('fast');

     } else {
       $parent.removeClass('active').slideUp('fast');
     }

   });
   
   //Email Builder Choose Template
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
          	//var obj = jQuery.parseJSON(data);
          	//alert(obj.data);
                    $('.content-main').html(data);
                }
            }); 
				}
			});
   
   
    CKEDITOR.replace( 'editor1' );
 });
 

 /*nice menu*/	
	
</script>

  </body>
</html>
