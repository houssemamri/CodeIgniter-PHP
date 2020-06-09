<?php
session_start();
if (!isset($_GET['id'])) {
  header('Location: ' . './');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="keywords" content="">

  <title>Thunder Review - Upload Video</title>

  <!-- Styles -->
  <link href="css/core.min.css" rel="stylesheet">
  <link href="css/thesaas.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
  <link rel="icon" href="img/favicon.png">
  <style>
    table{
        margin:0 auto;
      }
      .test{
        font-size:34px;
        text-align: left;
        margin-left:15px;
      }
      .pswp{
        display: none;
      }
    </style>
</head>

<body>


  <?php
    if(isset($_SESSION['global_status']))
      include('navbar.php');
    else
      include('navbar_guest.php');
  ?>

  <!-- Header -->
  <header class="header text-white" style="background-image: url(img/background.jpeg)" data-overlay="8">
    <div class="container text-center">

      <div class="row">
        <div class="col-lg-8 mx-auto">

          <h1 class="text-white">
            <table>
              <tr>
                <td>Video Upload</td>
                <td>
                  <!-- <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $header1;?>,<?php echo $header2;?>,<?php echo $header3;?>" data-type-speed="80"></span> -->
                </td>
              </tr>
            </table>

          </h1>

          <hr class="w-60px my-7">

          <a class="btn btn-lg btn-round btn-white text-uppercase" href="#main">Discover</a>

        </div>
      </div>

    </div>
  </header><!-- /.header -->

  <!-- END Header -->

  <!-- END Header -->
  <!-- Main container -->
  <main class="main-content" id="main">
    <h4 class="text-center mt-50">
      Upload Your Video Here
    </h4>
    <div class="text-center mt-50 mb-50">
      <?php
        if (isset($_GET['success'])) {
          if ($_GET['success'] === 'true') 
          { ?>
            <div class="row">
              <div class="col-md-6 mx-md-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your video has been uploaded successfully.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
          <?php
          } else 
          { ?>
            <div class="row">
              <div class="col-md-6 mx-md-auto">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Warning!</strong> Your video has not been uploaded successfully.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
      <?php
          }
        }
      ?>
      <div class="row">
        <div class="col-md-6 mx-md-auto">
        <form method="post" action="uploadVideoServer.php" enctype="multipart/form-data">
          <input type="text" hidden name="UID" value="<?php echo $_GET['id'];?>" />
          <input type="text" name="title" class="form-control" placeholder="Enter Title" />
          <input type="hidden" name="video_screenshot" value="" id="screenshot" />
          <select class="form-control mt-20" name="CID">
          <?php
              $sql = "SELECT * FROM videoCategory WHERE UID = " . $_GET['id'];
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {?>
                <option value="<?php echo $row['CID'];?>"><?php echo $row['Category'];?></option>
              <?php
              }
          ?>
          </select>
          <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
          <div id="videoDiv" style="padding: 3%"></div>
          <input type="file" name="capture" class="mt-20" accept="video/mp4" id="file-input"  /><br />
          <input type="submit" disabled="true" id="submitButton" value="Submit" class="btn btn-success mt-50" />
        </form>
      </div>
      
      </div>
      <div class="row">
	  	<div class="col-md-6 mx-md-auto">
	  		 
		    <canvas id="canvas-element" style="display: none"></canvas>
		    <div id="thumbnail-container">
		          <!--<a id="download-link" href="#">Download Thumbnail</a>-->
		    </div>
	  	</div>
	  </div>
    </div>
  </main>
  <!-- END Main container -->

  <!-- Scripts -->
  <script src="assets/js/page.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="js/core.min.js"></script>
  <script src="js/thesaas.min.js"></script>
  <script src="js/script.js"></script>


	<script>
		// On selecting a video file
		document.querySelector("#file-input").addEventListener('change', function() {
			
			
					 var x = document.createElement("VIDEO");

						if (x.canPlayType("video/mp4")) {
						    x.setAttribute("src",URL.createObjectURL(document.querySelector("#file-input").files[0]));
						} else {
						    x.setAttribute("src","movie.ogg");
						}

						x.setAttribute("width", "320");
						x.setAttribute("height", "240");
						x.setAttribute("controls", "controls");
						x.setAttribute("id", "video-element");
						x.setAttribute("onloadedmetadata", "drawImage()");
						//document.body.appendChild(x);
						document.getElementById("videoDiv").appendChild(x);
			
			
		    // Set object URL as the video <source>
		  //  document.querySelector("#video-element source").setAttribute('src', URL.createObjectURL(document.querySelector("#file-input").files[0]));
		
		});
		
	function drawImage(){
		//alert("Loaded Video")
		
		    var _VIDEO = document.querySelector("#video-element"),
   			 _CANVAS = document.querySelector("#canvas-element");
   			 
   			  _CANVAS.width = _VIDEO.videoWidth;
   			  _CANVAS.height = _VIDEO.videoHeight;
		 setTimeout(function(){ 	
			   _CANVAS_CTX = _CANVAS.getContext("2d");

			// Placing the current frame image of the video in the canvas
			_CANVAS_CTX.drawImage(_VIDEO, 0, 0, _VIDEO.videoWidth, _VIDEO.videoHeight);
			document.getElementById("screenshot").value =  _CANVAS.toDataURL();
			// Setting parameters of the download link
			document.querySelector("#download-link").setAttribute('href', _CANVAS.toDataURL());
			document.querySelector("#download-link").setAttribute('download', 'thumbnail.png');	
		    
		    document.getElementById("submitButton").disabled = false;
		    
		    }, 2000); 		

	}
	</script>


  <?php include('footer.php');?>






</body>

</html>