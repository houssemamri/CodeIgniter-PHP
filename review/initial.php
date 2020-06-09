<?php
session_start();
if(!isset($_SESSION['global_status'])){
  header('Location: ' . 'login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Article</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>

  <body>


  <?php include('navbar.php');?>

    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)" >
      <div class="container text-center">

        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">

            <h1><?php echo $welcome . " " . $_SESSION['user_name'];?>.</h1>
            <p class="fs-18 opacity-100" id="subHeader"><?php echo $welcomeMsg;?></p>

          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content">
      <br /><br />
      <h4 class="text-center">
        <?php echo $msgUsr;?>
      </h4>
      <br />
      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Horizontal Tab
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section" id="section-htab">
        <div class="container">
          <?php

          if(strcmp($_GET['name'],"Product")==0)
            $name= $sec5;
          else if(strcmp($_GET['name'],"Services")==0)
            $name= $sec6;
           ?>
          <div class="text-center">
            <ul class="nav nav-outline nav-round">
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="<?php echo $_GET['type'];?>.php?status=true&type=<?php echo $_GET['name'];?>B2B"><?php echo $name;?> B2B</a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link nav-user" href="<?php echo $_GET['type'];?>.php?status=true&type=<?php echo $_GET['name'];?>B2C"><?php echo $name;?> B2C</a>
              </li>
            </ul>
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
        <script src="js/select2.min.js"></script>
