<?php
session_start();
if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . './');
}
else if($_GET['id']!=$_SESSION['user_id'])
{
  header('Location: ' . 'manageVideo.php?id=' . $_SESSION['user_id']);
}
include('connection.php');



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Review Thunder">
    <meta name="description" content="From Answering to your Reviews to helping you increase them, Review Thunder is full of useful features. It would be a Pleasure to realise a Demo or to Give you Explanations">
  <meta name="keywords" content="">
  <meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI'];?>" >
  	<meta property="og:title" content="Video Share" >
  	<meta property="og:type" content="video/mp4" >
	<meta property="og:description" content="From Answering to your Reviews to helping you increase them, Review Thunder is full of useful features. It would be a Pleasure to realise a Demo or to Give you Explanations" >
	<meta property="og:image" content="https:review-thunder.com/img/logo-light.png" >
  <title>Thunder Review - Manage Videos</title>

  <!-- Styles -->
  <link href="css/core.min.css" rel="stylesheet">
  <link href="css/thesaas.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <script src="ckeditor/ckeditor.js"></script>
  <style>
    .nav-outline .nav-main:hover, .nav-outline .nav-main.active {
      color: #fff;
      background-color: #cd0a62;
    }
    .nav-outline .nav-link {
      border: 1px solid #cdcd !important;
    }
    .nav-outline .nav-category:hover, .nav-outline .nav-category.active {
      color: #fff;
      background-color: #3a97f9;
    }
    .tooltip {
    padding: 10px 19px !important;
}
    </style>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
  <link rel="icon" href="img/favicon.png">
	<!--Alertify JS link-->
	<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>-->

	
</head>

<body>

  <?php include('navbar.php');
  if(strcmp($lang,'en')==0)
    {
		$msg1 =	"Increase Your";
		$msg  = "Reputation, Credibility, Sales";
		
 	}else if(strcmp($lang,'spa')==0)
 	{
 		$msg1 =	"Augmentez votre";
		$msg  = "Reputatin, Ventes, Credibilite";
 	}
    else
    {
    	$msg1 =	"Aumentar tus";
		$msg  = "Reputacion, Ventas, crediilidad";
	}			
  ?>
  
  <!-- Header -->
  <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
    <div class="container text-center">

      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">

          <h1>
            <?php echo $_SESSION['user_name'];?> - Manage Videos</h1>
          <p class="fs-18 opacity-100" id="subHeader">Manage Videos</p>
        </div>
      </div>

    </div>
  </header>
  <!-- END Header -->




  <!-- Main container -->
  <main class="main-content">
    <section class="section bg-gray">
      <div class="container">
        <h3 class="text-center"><?php echo $manage_video_reviews;?></h3>
        <h4 class="text-center mt-20">
          <?php echo $msg1;?> <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $msg;?>"
            data-type-speed="80"></span>
        </h4>

        <section class="section bg-gray mt-30" style = "overflow: initial;" id="section-htab">
            <style>
                .avatar-article1{
                    position: relative;
                    left: -140px;
                    top: 137px;
                    width: 120px;
                }
                .bubble-article1 > span{
                    position: absolute;
                    top: -180px;
                    left: 125px;
                    width: 130px;
                    font-size: 11px;
                    max-height: 160px;
                    font-weight: 900;
                    line-height: 1.5;
                }
                .bubble-article1 > img{
                    position: absolute;
                    top: -240px;
                    left: 85px;
                    max-width: 210px;
                    max-height: 200px;
                    width: 210px;
                    height: 200px;
                }

                .avatar-article-img1{
                    position: absolute;
                    top: -80px;
                    width: 120px;
                }
                .share-video{
                    margin-right: 10px;
                }
                .edit-video,.share-video {
                    margin-bottom: 10px;
                }

                .video-share-button{
                    display: none;
                    position: absolute;
                    right: 56px;
                    top: 64px;
                    z-index: 9999;
                }
                .video-share-button.share-video-active{
                    display: grid;
                }
                .share-container{
                    position: relative;
                }
                /*
	   each item is given a slightly different animation delay
	   this is how each item is fired off individually
	*/

                .video-share-button.share-video-active button:nth-of-type(1) {

                    animation-delay:75ms;


                }
                /* each list item is incrementing by a delay of 75ms */
                .video-share-button.share-video-active button:nth-of-type(2) {

                    animation-delay:150ms;

                }
                .video-share-button.share-video-active button:nth-of-type(3) {

                    animation-delay:225ms;

                }

                /*
                    A very simple cascade animation,
                    from invisible and 70% of it's size
                    to 100% and visible
                */

                @keyframes cascadeInSimple {

                    0% {

                        /*opacity:0;*/
                        transform:scale(0.7);

                    }

                    100% {

                        /*opacity:1;*/
                        transform:scale(1);

                    }
                }
                .video-share-button.share-video-active button {

                    animation: cascadeInSimple 1s 1s ease-in-out backwards alternate 0;

                }
                @media (max-width: 576px) {


                    .modal-footer{
                        display: block;
                    }
                    .modal-footer>:not(:first-child), .modal-footer>:not(:last-child){
                         margin-left: 0;
                        margin-bottom: 5px;
                    }
                    .modal-footer button{
                        width:100%;
                    }
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
            <div class="avatar-article avatar-article1">
                <div class="bubble-article1">
                    <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
                    <span><?=$avatarTextVideo?></span>
                </div>
                <img class="avatar-article-img1" src="avatar/img/avatar/<?=$row['avatar']?>.png">
            </div>
          <div class="container">

            <div class="text-center">
              <ul class="nav nav-outline nav-round">
                <li class="nav-item w-140">
                  <a class="nav-link nav-main active" data-toggle="tab" href="#manage"><?php echo $manage_videos;?></a>
                </li>
                <li class="nav-item w-140">
                  <a class="nav-link nav-main" data-toggle="tab" href="#increase"><?php echo $manage_videos_increase;?></a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="manage">
                  <div class="text-center mt-50">
                  <ul class="nav nav-outline nav-round">
                    <?php
                    $sql = "SELECT * FROM videoCategory WHERE UID =" . $_GET['id'];
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                      if ($row['CID'] == 1) {
                        $classList = "nav-link nav-category active";
                      } else {
                        $classList = "nav-link nav-category";
                      }?>
                    <li class="nav-item w-140">
                      <a class="<?php echo $classList; ?>" data-toggle="tab" href="#<?php echo $row['Category'];?>">
                        <?php echo $row['Category'];?></a>
                    </li>
                    <?php
                    }
                  ?>
                  </ul>
                  <button class="btn btn-circle btn-primary" id="add-category"><i class="fa fa-plus"></i></button>
                </div>
                <div class="tab-content">
                    <?php 
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                      if ($row['CID'] == 1) {
                        $classList = "tab-pane fade show active";
                      } else {
                        $classList = "tab-pane fade";
                      }?>
                    <div class="<?php echo $classList;?>" id="<?php echo $row['Category'];?>">
                      <div class="row mt-100">
                        <?php
                            $sql = "SELECT * FROM video WHERE CID = " . $row['CID'] . " AND UID=" . $_GET['id']; 
                            $result1 = $conn->query($sql);
                            if ($result1->num_rows > 0) {
                                while ($row1 = $result1->fetch_assoc()) 
                                { ?>
                        <div class="col-md-4 text-center">
                          <a target="_blank" href="https://review-thunder.com/singlevideo/video/<?php echo $_SESSION['user_id'];?>/<?php echo $row1['VID'];?>/<?php echo  $row['CID'];?>">
                          <h3>
                            <?php echo $row1['Name'];?>
                          </h3></a><button class="btn btn-circle btn-success pull-right edit-video" data-category="<?php echo $row['CID'];?>"
                            data-id="<?php echo $row1['VID'];?>" data-title="<?php echo $row1['Name'];?>"><i class="fa fa-pencil"></i></button>
                            <div class="share-container">
                                 <div class="main-video-share-button">
                                    <button class="btn btn-circle btn-success pull-right share-video" data-category="<?php echo $row['CID'];?>"
                                        data-id="<?php echo $row1['VID'];?>" data-title="<?php echo $row1['Name'];?>"><i class="fa fa-share-alt"></i></button>
                                 </div>
                                <div class="video-share-button">
                                    <button class="btn btn-circle btn-facebook pull-right share-video" data-category="<?php echo $row['CID'];?>"
                                            data-id="<?php echo $row1['VID'];?>" data-title="<?php echo $row1['Name'];?>"><i class="fa fa-facebook"></i></button>
                                    <button class="btn btn-circle  btn-google pull-right share-video" data-category="<?php echo $row['CID'];?>"
                                            data-id="<?php echo $row1['VID'];?>" data-title="<?php echo $row1['Name'];?>"><i class="fa fa-google"></i></button>
                                    <button class="btn btn-circle  btn-linkedin pull-right share-video" data-category="<?php echo $row['CID'];?>"
                                            data-id="<?php echo $row1['VID'];?>" data-title="<?php echo $row1['Name'];?>"><i class="fa fa-linkedin"></i></button>
                                </div>
                            </div>
                          <video width="320" height="240" controls >
                            <source src="<?php echo $row1['Path'];?>" type="video/mp4"/>
                          </video>
                          
                          <?php  
                          // Removing '.' from link(DT)
                          $video_path =  $row1['Path'];
                          /*if($video_path['0']=='.'){
						  	$video_path['0']='';
						  }*/
							$video_path = ltrim($video_path, '.');
						  ;?>
						<!--  <h3><?php echo $share_videos;?></h3>-->
						  <!--Genrating Social Media Share Link-->
                          <!--<a class="btn btn-primary" target="_blank" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/sharer.php?u=https://review-thunder.com<?php echo $video_path;?>"><i class="fa fa-facebook-f"></i></a>--><!--Genrating Facebook Link-->
                          
                         <!-- <a class="btn btn-primary" target="_blank" data-toggle="tooltip" title="Google Plus" href="https://plus.google.com/share?url=https://review-thunder.com<?php echo $video_path;?>"><i class="fa fa-google-plus"></i></a>--><!--Genrating google plus Link-->
                        </div>
                        <?php 
                                }
                            } else {?>
                        <div style="margin:0 auto;">No Video(s) Present.</div>
                        <?php
                              }
                            ?>
                      </div>
                    </div>
                    <?php 
                  }
                  ?>
                  </div>
              </div>
              <div class="tab-pane fade" id="increase">
                  <div class="text-center mt-50">
                    <ul class="nav nav-outline nav-round">
                      <li class="nav-item w-140">
                        <a class="nav-link active" data-toggle="tab" href="#email">Email</a>
                      </li>
                      <li class="nav-item w-140">
                        <a class="nav-link" data-toggle="tab" href="#sms">SMS</a>
                      </li>
                      <li class="nav-item w-140">
                        <a class="nav-link" data-toggle="tab" href="#web">Web</a>
                      </li>
                      <!--<li class="nav-item w-140">
                        <a class="nav-link" data-toggle="tab" href="#publish">Publish On Your Site</a>
                      </li>-->
                    </ul>
                  </div>
                  <div class="tab-content mt-30 text-center">
                    <div class="tab-pane fade show active" id="email">
                        <form action="sendVideoEmail.php" method="POST">
                          <input type="text" hidden name="UID" value="<?php echo $_GET['id'];?>" />
                          <select class="form-control" id="LID" name="LID" required>
                            <option value=""disabled selected><?php echo $selectlist;?></option>
                            <?php
                              $sql="SELECT * FROM EmailListMain WHERE UID=" . $_GET['id'];
                              $result = $conn->query($sql);
                              while($row = $result->fetch_assoc()) {?>
                                <option value="<?php echo $row['LID'];?>"><?php echo $row['ListName'];?></option>
                              <?php
                              }
                            ?>
                          </select>
                          <br>
                          <textarea name="content" id="editor1" class="form-control"  style="height:150px;margin-top:20px;"></textarea>
                          <button type="submit" name="submit" class="btn btn-success mt-20"><?php echo $send;?></button>
                        </form>
                    </div>
					 <div class="tab-pane fade" id="web">
					    <textarea name="" readonly="" id="iframeCodee" class="form-control"  style="display: none"><iframe src="https://review-thunder.com/uploadVideo.php?id=<?php echo $_GET['id'];?>" height="500" width="500" style="border:none;"></iframe></textarea>
					   <!-- <iframe class="frame1"  src="https://review-thunder.com/uploadVideo.php?id=<?php echo $_GET['id'];?>"></iframe>-->
					    <iframe class="frame1"  src="https://www.bing.com/"></iframe>
					    <small>*Some websites don't work with iframes</small><br>
					     <!--<input type="hidden"  id="iframeCodee" class="form-control" value="https://review-thunder.com/uploadVideo.php?id=<?php echo $_GET['id'];?>" />-->
					    <button onclick="copyFunction()" class="btn btn-success mt-20">Copy code</button>
					  </div>
					  
                  </div>
                  <!-- <div class="row mt-80">
                    <label>Share Link:</label>
                    <input type="text" id="link" class="form-control" value="http://review-thunder.com/uploadVideo.php?id=<?php echo $_GET['id'];?>" />
                    <div style="margin:0 auto;">
                      <input type="button" class="btn btn-success mt-20" value="Copy Link" id="copy-link" />
                    </div>
                  </div> -->
              </div>
            </div>
            
            
            <!-- Modal - Edit Video -->
           <div class="modal fade" id="modal-edit-video" tabindex="-1" role="dialog" aria-labelledby="modalVideo" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo $editvideo;?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                <input type="text" hidden name="VID" id="VID" />
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" />
                <select class="form-control mt-20" name="CID" id="CID">
                <?php
                    $sql = "SELECT * FROM videoCategory WHERE UID = " . $_GET['id'];
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {?>
                      <option value="<?php echo $row['CID'];?>"><?php echo $row['Category'];?></option>
                    <?php
                    }
                    $conn->close();
                ?>
                </select>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $cancelvideo;?></button>
                  <button type="button" class="btn btn-primary" id="update-db"><?php echo $updatevideo;?></button>
                  <button type="button" class="btn btn-danger" id="delete-video"><?php echo $deletevideo;?></button>
                </div>
              </div>
            </div>
          </div>




          </div>
        </section>



      </div>
    </section>

  </main>
  <!-- END Main container -->





  <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


<?php 
//checking mail sending stATUS	
if(isset($_REQUEST['suc']) && $_REQUEST['suc']=='1'){
	$success = "1";
}
if(isset($_REQUEST['err']) && $_REQUEST['suc']=='0'){
echo "<div style='width:100%;text-align:center;' class='alert alert-danger' id='contact-success'>Something went wrong!<a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}

?>

  <!-- Scripts -->
  <script src="assets/js/page.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="js/core.min.js"></script>
  <script src="js/thesaas.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/select2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>
 <script type="text/javascript">
 	  
		function copyFunction() {
		  /* Get the text field */
		  var copyText = document.getElementById("iframeCodee");
		  copyText.focus();
		  /* Select the text field */
		  copyText.select();
		  /* Copy the text inside the text field */
		  document.execCommand("copy");
		  /* Alert the copied text */
		  alert("Copied the text: " + copyText.value);
		}
 </script>
<script type="text/javascript">

	   CKEDITOR.replace( 'editor1',
                {
     filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
     filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
     filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
     filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
 });
 CKEDITOR.instances.editor1.setData("http://review-thunder.com/uploadVideo.php?id=<?php echo $_GET['id'];?>");       
</script>
  <script type="text/javascript">


  
  
  	/*Showing status useing alertify js notifier*/
if("1" == <?php echo $success;?>){
	  alertify.success('Success message');
	  console.log("success");
}
  </script>
  <script>
   /* $('#copy-link').on('click', function () {
      console.log('Clicked!');
      CopyToClipboard('link');
    });*/

   /* function CopyToClipboard(containerid) {
      const copyText = document.getElementById(containerid);
      copyText.select();
      document.execCommand("copy");
    }*/
    $('#add-category').on('click', function () {
      location.href = './manageCategory.php?id=<?php echo $_GET['id']; ?>';
    });
    $('.edit-video').on('click', function () {
    	//alert('clicked');
      $('#modal-edit-video').modal('show');
      $('#VID').val($(this).data('id'));
      $('#title').val($(this).data('title'));
      $('#CID').val($(this).data('category'));
    });
    $('#update-db').on('click', function () {
      if ($('#title').val() !== '') {
        $.ajax({
          url: 'updateVideo.php',
          type: 'POST',
          data: {
            CID: $('#CID').val(),
            title: $('#title').val(),
            VID: $('#VID').val()
          },
          success: function (data) {
            location.reload();
          }
        });
      }
    });
    $('#delete-video').on('click', function () {
      const r = confirm('Do you want to delete it?');
      if (r === true) {
          $.ajax({
          url: 'deleteVideo.php',
          type: 'POST',
          data: {
            VID: $('#VID').val()
          },
          success: function (data) {
            location.reload();
          }
        });
      }
    });
    $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
   $(".share-video").on('click', function(){
       console.log();
       if( $(this).parent(".main-video-share-button").siblings(".video-share-button").hasClass("share-video-active") ) {

           $(this).parent(".main-video-share-button").siblings(".video-share-button").removeClass("share-video-active");

       }else{

           $(this).parent(".main-video-share-button").siblings(".video-share-button").addClass("share-video-active");

       }
   });
});


  </script>
 
 <?php include('footer.php');?>
 
</body>

</html>