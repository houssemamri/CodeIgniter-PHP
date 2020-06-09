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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
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
    <?php 
    if(isset($_POST['sub'])){
    	
    	extract($_POST);
		
		/*$temp_name = $_POST['temp_name'];
		$temp_code = $_POST['temp_code'];
		
		echo "<pre>";
		print_r($_POST);*/
		
		
		$sql = "INSERT INTO add_email(temp_name,temp_code) VALUES ('".$template_name."','".$template_code."')";
		$insert = mysqli_query($conn,$sql);
		if(!$insert){
			echo 'failed'.mysqli_error($conn);
		} 
		
	}
	
	//EDIT QUERY & UPDATE QUERY
if(isset($_GET['mode'])=='edit' && $_GET['num'] != ''){
	$sql = "SELECT * FROM add_email WHERE id=".$_GET['num'];
	$query = mysqli_query($conn,$sql);
	$result = mysqli_fetch_object($query);
	
	if(isset($_POST['update'])){
    	
    	extract($_POST);
    $sql = "UPDATE add_email SET temp_name='".$template_name."',temp_code='".$template_code."' WHERE id=".$_GET['num'];	
    $query = mysqli_query($conn,$sql);	
	}
		
}

	
    ?>
    <section class="section" id="section-vtab">
    <div class="container">
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
              <ul class="nav nav-vertical">
                <li class="side nav-item">
                  <a class="nav-link <?php echo $main;?> " data-toggle="tab" href="#home">
                    <h6><?php echo $adminHome;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#profile">
                    <h6><?php echo $editProfile;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#link">
                    <h6><?php echo $editLinks;?></h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab"  href="#mybusiness">
                    <h6><?php echo $my_business_account;?></h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab"  href="#newsletter">
                    <h6>Newsletter</h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#mail">
                    <h6><?php echo $sendEmails;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link <?php echo $mail;?>" data-toggle="tab" href="#managemail">
                    <h6><?php echo $manageEmail;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link <?php echo $list;?>" data-toggle="tab" href="#managelist">
                    <h6><?php echo $manageEmailList;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#userprefer">
                    <h6><?php echo $userPrefer;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#todo">
                    <h6><?php echo $todoName;?></h6>
                  </a>
                </li>
				 <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" onclick="get_content('posts','posts_div')" href="#posts_div">
                    <h6><?php echo $Posts;?></h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" onclick="get_content('tools','tools_div')" href="#tools_div">
                    <h6><?php echo $tools;?></h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" onclick="get_content('networks','networks_div')" href="#networks_div">
                    <h6><?php echo $networks;?></h6>
                  </a>
                </li>			
				<!--<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" onclick="get_content('bots','bots_div')" href="#bots_div">
                    <h6>Bots</h6>
                  </a>
                </li>	-->		
				<li class="side nav-item" style="display:none;">
                  <a class="nav-link" data-toggle="tab" onclick="get_content('settings','settings_div')" href="#settings_div">
                    <h6><?php echo $Settings;?></h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#qrcode_gent">
                    <h6>QrCode</h6>
                  </a>
                </li>
				<li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#facebook_gent">
                    <h6>Facebook</h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link"  href="addEmail.php?id=<?php echo $_SESSION['user_id'] ?>">
                    <h6>Add Email</h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link"  href="viewEmail.php?id=<?php echo $_SESSION['user_id'] ?>">
                    <h6>View Email</h6>
                  </a>
                </li>
              </ul>
            </div>
            
			<div class="col-md-9">
			<h2><?php if(isset($_GET['mode'])=='edit'){?>Edit <?php }else{ ?>Add <?php };?>E-mail Template</h2>
				<form action="" method="post">
					<div class="form-group">
						<label for="template_name">Template Name</label> 
						<input type="text" name="template_name" id="template_name" class="form-control" 
						value="<?php if(isset($_GET['mode'])=='edit'){ echo $result->temp_name;}?>"/>
					</div>
					<div class="form-group">
						<label for="template_code">Template Code</label>
						<textarea name="template_code" id="template_code" rows="15" cols="5" class="form-control" >
						<?php if(isset($_GET['mode'])=='edit'){ echo $result->temp_code;}?>	
						</textarea>
					</div>
					<button class="btn btn-primary" <?php if(isset($_GET['mode'])=='edit'){?> name="update"<?php }else{ ?> name="sub<?php };?>">Submit</button>
				</form>
			</div>
			
			           <!-- <div class="col-12 col-md-9 align-self-center">-->
              <div class="tab-content">
                <div class="tab-pane fade show <?php echo $main;?>" id="home">
              <!--    <div class="col-lg-12 text-center">
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
                        <img src="<?php echo $path . "/" . $row1['imagePath'];?>" alt="" height="75" width="75" />
                      <?php
                      echo $row['Name'];?></span><br />
                      <span id="company"><?php echo $registerCompany . " : " . $row['Company'];?></span><br />
                      <span id="position"><?php echo $row['Position'];?></span><br />
                      <span id="email"><?php echo trim($email[0]);?></span><br />
                      <span id="contact"><?php echo $row['Contact'];?></span><br />
                  </div>
                  <br /><br />
                  <div class="col-lg-12">
                    <img src="img/<?php echo $toDoList;?>"/><br /><br /><br />
                    <?php
                    $sql="SELECT * FROM todolist WHERE UID=" . $_GET['id'];
                    $result1=$conn->query($sql);
                    if($result1->num_rows==0)
                    {?>
                    <span class="text-center">
                      <?php echo "No List Found";?>
                    </span>
                    <?php
                    }
                    else
                    {?>
                      <div class="row text-center">
                      <?php
                        while($row1=$result1->fetch_assoc())
                        {?>
                            <div class="col-md-4">
                              <input type="checkbox" <?php if($row1['Done']==1) { echo "checked"; }?> disabled/>
                              <?php echo $row1['Item'];?>
                            </div>
                        <?php
                        }?>
                        </div>
                    <?php
                    }
                    ?>
                  </div>
                </div>-->
<div class="tab-pane fade" id="mybusiness">


				<?php include('mybusiness.php'); ?>
				</div>
<div class="tab-pane fade" id="newsletter">


				<?php include('loadnewsletter.php'); ?>
				</div>
                <div class="tab-pane fade text-center" id="profile">
                  <?php include('editProfile.php');?>
                </div>

                <div class="tab-pane fade text-center" id="link">
                  <?php include('profileHome.php'); ?>
                </div>

                <!--<div class="tab-pane fade" id="mail">
                  <?php include('multiMail.php'); ?>
                </div>-->

                <div class="tab-pane fade text-center  <?php echo $mail;?>" id="managemail">
                  <?php include('manageEmail.php'); ?>
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

              </div>
            </div>
			<div class="clearfix"></div>
		<!--</div>-->
	</div>
  </section>  

    
    <?php include('footer.php');?>
  
  <script>
     CKEDITOR.replace( 'template_code' );
    /* document.getElementById('template_code').value = 'hi';*/
    
</script>
<a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/select2.min.js"></script>
<!--	<script src="qrcode/js/all.js"></script>-->

    <script>
	
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
                location.href='https://www.review-thunder.com/profile.php?id=2&type=2';
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
        function updateEmail(id)
        {
          var m=$('#updateMail'+id).val();
          var e=$('#hiddenEid'+id).val();
          var f=$('#firstName'+id).val();
          var l=$('#lastName'+id).val();
          var c=$('#company'+id).val();
          var p=$('#mobile'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "updateMultiMail.php",
            data: {eid:e,mail:m,first:f,last:l,company:c, mobile: p},
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
          jQuery.ajax({
            type: "POST",
            url: "addItem.php",
            data: {uid:u,item:i},
            success: function(response){
              $('#todoitem').val('');
            }
          });
        }
        function updateTodo(id)
        {
          var i=$('#updateItem'+id).val();
          var t=$('#hiddenTid'+id).val();
          jQuery.ajax({
            type: "POST",
            url: "updateItem.php",
            data: {tid:t,item:i},
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
              $("#addItem"+id+" input[type='checkbox']").attr("disabled", true);
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
$('.nav-link a').click(function(e) {
    e.preventDefault();
    $(this).tab('show');
});

// store the currently selected tab in the hash value
$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
});

// on load of the page: switch to the currently selected tab
var hash = window.location.hash;
$('.nav-link a[href="' + hash + '"]').tab('show');

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
</script>
