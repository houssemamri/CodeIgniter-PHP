<?php
session_start();
include_once "common_function.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Contact</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
 <style>
 	.nav-link{
 		color: #000 !important;
 	}
 </style>
  </head>

  <body>


  <?php
  if(isset($_SESSION['global_status']))
    include('navbar.php');
  else
    include('navbar_guest.php');
  if(strcmp($lang,'en')==0)
  {
    $contactTitle = "Contact";
    $contactMessage = "Don't hesitate to contact us. We will answer within 24 hours.";
    $yourName = "Your Name";
    $yourEmail = "Your Email";
    $yourMessage = "Your Message";
    $submitEnquiry = "Submit Enquiry";
    $address = "Address";
    $telephone = "Telephone";
  }
  else if(strcmp($lang,'spa')==0)
  {
    $contactTitle = "Contacto";
    $contactMessage = "No dude en contactarnos, le responderemos en 24 horas.";
    $yourName = "Su Nombre";
    $yourEmail = "Su Direccion Email";
    $yourMessage = "Su Mensaje";
    $submitEnquiry = "MANDAR SU MENSAJE";
    $address = "Direccion";
    $telephone = "Teléfono";
  }
  else
  {
    $contactTitle = "Contact";
    $contactMessage = "N’hésitez pas à nous contacter, nous vous Répondrons dans les 24 Heures.";
    $yourName = "Votre Nom";
    $yourEmail = "Votre Adresse Email";
    $yourMessage = "Votre Message";
    $submitEnquiry = "ENVOYEZ VOTRE MESSAGE";
    $address = "Adresse";
    $telephone = "Téléphone";

  }

  ?>


    <!-- Header -->
    <section class="section text-white" style="background-image: linear-gradient(-225deg, #5D9FFF 0%, #B8DCFF 48%, #6BBBFF 100%);">
        <div class="container">
          <header class="section-header" style="margin-top:80px;">
            <h1 class="text-white"><?php echo $contactTitle;?></h1>
            <p><?php echo $contactMessage;?></p>
          </header>

        </div>
    </section>
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content">




      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Contact form
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <section class="section bg-img" style="background-image: url('img/10.jpg');" data-overlay="8">
        <div class="container">
          <div class="row gap-y">

            <div class="col-11 col-md-6 mx-auto mx-md-0">
              <form class="row input-border" action="userSupport.php" method="POST" data-form="mailer">
                <div class="col-md-10 mx-auto bg-white p-6 rounded" style="padding:40px">
                  <?php
                  /*    if(strcmp($_GET['success'],"true")==0)
                      {
                   ?>
                      <div class="alert alert-success" id="contact-success">We received your message and will contact you back soon.</div>
                  <?php
                      }
                      else if(strcmp($_GET['success'],"false")==0)
                      {?>
                         <div class="alert alert-danger" id="contact-success">The message failed to deliver. Please try again later.</div>
                      <?php
                    }*/
                   ?>

                   <div class="form-group">
                     <input class="form-control form-control-lg" required="" style="background: rgb(232, 240, 254)"  type="text" name="sname" id="contact-name" placeholder="<?php echo $yourName;?>">
                   </div>

                   <div class="form-group">
                     <input class="form-control form-control-lg" required="" type="text" name="email" style="background: rgb(232, 240, 254)" id="contact-email" placeholder="<?php echo $yourEmail;?>">
                   </div>

                   <div class="form-group">
                     <textarea class="form-control form-control-lg" required="" style="background: rgb(232, 240, 254)" rows="4" name="message" placeholder="<?php echo $yourMessage;?>" id="contact-message"></textarea>
                   </div>

                     <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $submitEnquiry;?></button>


                </div>
              </form>
            </div>


            <div class="col-11 col-md-4 mx-auto text-white pt-6">
              <h6 class="text-white"><?php echo $address;?></h6>
              <p>3 Rue Benjamin Godard<br />
              75116 Paris<br />
              FRANCE</p>
              <br>
              <h6 class="text-white"><?php echo $telephone;?></h6>
              <p>+33.1.450.450.00<br />
              +33.6.43.88.09.26</p>
              <br>
              <h6 class="text-white">Email</h6>
              <p>edouard@review-thunder.com<br />
              e.richemond@webmarketing-tourisme.com</p>
            </div>

          </div>
        </div>
      </section>




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
