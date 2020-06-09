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

    <title>Thunder Review - Support</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>

  <body>


  <?php include('navbar.php');?>


    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/background.jpeg)" data-overlay="8">
      <div class="container text-center">

        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">

            <h1><?php echo $supportTitle;?></h1>

          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content">




      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Contact form
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class="section">
        <div class="container">

          <div class="row gap-y">
            <div class="col-12 col-md-6">
              <?php
                  if(strcmp($_GET['success'],"true")==0)
                  {
               ?>
                  <div class="alert alert-success" id="contact-success">We received your message and will contact you back soon.</div>
              <?php
                  }
                  else if(strcmp($_GET['success'],"false")==0)
                  {?>
                     <div class="alert alert-danger" id="contact-success">The message failed to deliver. Please try again later.</div>
                  <?php
                  }
               ?>



          <form action="userSupport.php" method="POST">
              <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="sname" id="contact-name" placeholder="<?php echo $yourName;?>">
              </div>

              <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="email" id="contact-email" placeholder="<?php echo $yourEmail;?>">
              </div>

              <div class="form-group">
                <textarea class="form-control form-control-lg" rows="4" name="message" placeholder="<?php echo $yourMessage;?>" id="contact-message"></textarea>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $sendSupport;?></button>
              </div>
          </form>
            </div>


            <div class="col-12 col-md-5 offset-md-1">
              <div class="bg-grey h-full p-20">
                <?php echo $contactInfo;?>

                <hr class="w-80">

                <p class="lead">3 Rue Benjamin Godard, 75116 Paris, France</p>


                <div>
                  <span class="d-inline-block w-20 text-lighter" title="Website">W:</span>
                  <span class="fs-14"><a href="http://ecsp-sociallyperforming.eu">ecsp-sociallyperforming.eu</a></span>
                </div>

                <div>
                  <span class="d-inline-block w-20 text-lighter" title="Email">E:</span>
                  <span class="fs-14">edouard@review-thunder.com</span>
                </div>

                <div>
                  <span class="d-inline-block w-20 text-lighter" title="Phone">P:</span>
                  <span class="fs-14">+33.1.450.450.00</span>
                </div>

              </div>
            </div>
          </div>


        </div>
      </div>




      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Map
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class="h-400" id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d584.563356490606!2d2.2752186495255295!3d48.865824977822776!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66557a38c1fff%3A0xdc4deb1a696bfab5!2sSocially+Performing!5e0!3m2!1sen!2s!4v1498806749046" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe></div>





    </main>
    <!-- END Main container -->



    <?php include('footer.php');?>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
