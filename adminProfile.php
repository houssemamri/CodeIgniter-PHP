<?php
session_start();
if(!isset($_SESSION['admin_status'])){
  header('Location: ' . 'auth/index');
}
include_once "common_function.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Admin Panel</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
    <style>
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
      .nav-vertical .nav-link:hover {
		color: white;
	}
    .nav-vertical .nav-link h6:hover {
		color: white;
	}
	.nav-vertical .nav-link h6 {
		width: 100%;
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

            <h1><?php echo $_SESSION['user_name'];?> - Admin</h1>
            <p class="fs-18 opacity-100" id="subHeader"><?php echo $adminWelcome;?>.</p>

          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->



    <!-- Main container -->
    <main class="main-content">

      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Vertical Tab
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section" id="section-vtab">
        <div class="container">

          <div class="row gap-5">


            <div class="col-12 col-md-3">
              <ul class="nav nav-vertical">
                <li class="side nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">
                    <h6><?php echo $adminHome;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" href="register.php">
                    <h6><?php echo $adminRegister;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" href="blog/admin/?id=<?php echo $_SESSION['user_id'];?>">
                    <h6>Blog Admin Panel</h6>
                  </a>
                </li>

                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#support">
                    <h6 ><?php echo $adminSupport;?></h6><span style="font-size:12px;font-weight:bold;">
                    <?php $sql="SELECT count(SID) as Unread FROM Support WHERE Status=0";
                    $result=$conn->query($sql);
                    $row=$result->fetch_assoc();
                    echo $row['Unread'] . "  " . $unreadMessage;?></span>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#delete">
                    <h6><?php echo $deleteUser;?></h6>
                  </a>
                </li>
                <li class="side nav-item">
                  <a class="nav-link" data-toggle="tab" href="#manageLimit">
                    <h6>Manage User Limit</h6>
                  </a>
                </li>
              </ul>
            </div>


            <div class="col-12 col-md-9 align-self-center">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="home">
                </div>


                <div class="tab-pane fade" id="support">
                  <?php include('adminSupport.php');?>
                </div>
                <div class="tab-pane fade" id="delete">
                  <?php include('adminDelete.php');?>
                </div>
				<div class="tab-pane fade" id="manageLimit">
                  <?php include('manageUserLimit.php');?>
                </div>
              </div>
            </div>


          </div>


        </div>
      </section>



    </main>
	
    <!-- END Main container -->
	
    <?php include('footer.php');?>


    <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

    <script>
            function userDelete(i)
            {
              var r = confirm("<?php echo $confirm;?>");
              if(r==true)
              {
                jQuery.ajax({
                 type: "POST",
                 url: "delete.php",
                 data: {id:i},
                 success: function(response){
                    window.location.href="adminProfile.php";
                 }
                 });
              }
            }
            function markRead(i)
            {
              jQuery.ajax({
               type: "POST",
               url: "markRead.php",
               data: {id:i},
               success: function(response){
                  window.location.href="adminProfile.php";
               }
               });
            }

    </script>

  </body>
</html>
