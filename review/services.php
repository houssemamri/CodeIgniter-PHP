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

    <title>Thunder Review - Services</title>

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
    <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
      <div class="container text-center">

        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">

            <h1><?php echo $ourService; ?></h1>
          </div>
        </div>

      </div>
    </header>

    <!-- END Header -->

    <!-- END Header -->
    <!-- Main container -->
    <main class="main-content">



      <div class="section">
        <div class="container text-center">
          <div class="row">
            <div class="col-md-12">
                <img src="img/services/<?php echo $serv1;?>" class="img-responsive" /><br /><br /><br /><br />
            </div>
          </div>


        </div>
      </div>






    </main>
    <!-- END Main container -->



    <?php include('footer.php');?>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
