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
<html lang="en" xmlns="w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta property="og:url"       	content="https://review-thunder.com/singleVideoDetails.php" />
  	<meta property="og:title"       content="Video Share" />
  	<meta property="og:type"        content="video" />
  	  <!--	<meta property="og:type" content="video/mp4" >-->
	<meta property="og:description" content="From Answering to your Reviews to helping you increase them, Review Thunder is full of useful features. It would be a Pleasure to realise a Demo or to Give you Explanations" />
	<meta property="og:image"       content="https://review-thunder.com/img/1ANSWER.png" />
  	<meta property="og:video:width" content="800" />
  	<meta property="og:video"       content="https://review-thunder.com/videos/video1536149363.mp4" />
  	<meta property="fb:app_id"       content="374091426531279" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="author" content="Review Thunder" />
    <meta name="description" content="From Answering to your Reviews to helping you increase them, Review Thunder is full of useful features. It would be a Pleasure to realise a Demo or to Give you Explanations" />
  <meta name="keywords" content="" />
 
  <title>Thunder Review </title>
 

  <!-- Styles -->
  <link href="css/core.min.css" rel="stylesheet" />
  <link href="css/thesaas.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
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
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
  <link rel="icon" href="img/favicon.png" />
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
 <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  
  
  <?php include('navbar.php');?>
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

       
          <div class="container">
          
             
                  
             
                    <?php 
                     $sql = "SELECT * FROM videoCategory WHERE UID =" . $_GET['id'];
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
                            $sql = "SELECT * FROM video WHERE CID = " . $row['CID'] . " AND UID=" . $_GET['id']." AND VID=".$_GET['video_id']; 
                           // echo $sql;
                            $result1 = $conn->query($sql);
                            if ($result1->num_rows > 0) {
                                while ($row1 = $result1->fetch_assoc()) 
                                { ?>
                        <div class="col-md-12 text-center">
                         
                          <h3>
                            <?php echo $row1['Name'];?>
                          </h3>
                         
                          <video width="800" height="500" controls >
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
						  <h3><?php echo $share_videos;?></h3>
						  <!--Genrating Social Media Share Link-->
                          <a class="btn btn-primary" target="_blank" data-toggle="tooltip" title="Facebook" href="http://www.facebook.com/sharer.php?u=https://review-thunder.com<?php echo $video_path;?>"><i class="fa fa-facebook-f"></i></a><!--Genrating Facebook Link-->
                          <!-- Your share button code -->
						  <div class="fb-share-button" 
						    data-href="https://review-thunder.com/singleVideoDetails.php" 
						    data-layout="button_count">
						  </div>
                          <a class="btn btn-primary" target="_blank" data-toggle="tooltip" title="Google Plus" href="https://plus.google.com/share?url=https://review-thunder.com<?php echo $video_path;?>"><i class="fa fa-google-plus"></i></a><!--Genrating google plus Link-->
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
});


  </script>
 
 <?php include('footer.php');?>
 
</body>

</html>