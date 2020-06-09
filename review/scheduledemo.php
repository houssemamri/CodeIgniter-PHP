<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Schedule Demo</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>

  <body>


  <?php
  if(isset($_SESSION['global_status']))
    include('navbar.php');
  else
    include('navbar_guest.php');
  if(strcmp($lang,'en')==0)
  {
    $demoHeader = '<span class="text-white">Request</span> <span style="color:#00aef0;">Demo</span>';
    $demoText = 'Submit your request using the following form to schedule a demo session with one of our experts!';
    $scheduleHeader = 'Schedule your personal demo';
    $scheduleText = 'We can\'t wait to show you the world\'s most powerful Software as a Service (SaaS) admin template. Tell us a few things about yourself and we\'ll show you a lot more about us.';
    $name = "Name";
    $company = "Company Name";
    $email = "Email";
    $telephone = "Telephone";
    $scheduleDemo = "Schedule Demo";

  }
  else if(strcmp($lang,'spa')==0)
  {
    $demoHeader = '<span class="text-white">Solicitar</span> <span style="color:#00aef0;">una Demostracion</span>';
    $demoText = 'Presente su solicitud y le organizaremos una cita con uno de nuestros expertos';
    $scheduleHeader = 'Reserve su demostración personal';
    $scheduleText = 'Este programa contiene numerosas funciones ideales para administrar las calificaciones de sus clientes. Para nosotros es un placer presentárselo y aconsejarlo.';
    $name = "Nombre";
    $company = "Empresa";
    $email = "Email";
    $telephone = "Telefono";
    $scheduleDemo = "RESERVE UNE DEMOSTRACION";

  }
  else
  {
    $demoHeader = '<span class="text-white">Demander</span> <span style="color:#00aef0;">une Démo</span>';
    $demoText = 'Soumettez votre Requête et nous vous organiserons un Rendez-vous avec un de nos experts';
    $scheduleHeader = 'Réservez votre Démonstration Personelle';
    $scheduleText = 'Ce Logiciel contient de nombreuses Fonctionalités idéales à la gestion de vos avis clients. Nousn ous ferons un plaisir de vous les présenter et de vous conseiller';
    $name = "Nom";
    $company = "Enterprise";
    $email = "Email";
    $telephone = "Téléphone";
    $scheduleDemo = "RÉSERVER UNE DÉMONSTRATION";

  }

  ?>



  <!-- Header -->
  <header class="header header-inverse bg-fixed" style="background-image: url(img/background.jpeg)" data-overlay="8">
    <div class="container text-center">

      <div class="row">
        <div class="col-md-8 mx-auto">

          <h1><?php echo $demoHeader; ?></h1>
          <p class="lead-2 opacity-90 mt-6"><?php echo $demoText; ?></p>

        </div>
      </div>

    </div>
  </header><!-- /.header -->




    <!-- Main container -->
    <main class="main-content">

      <!--
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        | Request form
        |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
        !-->
        <section class="section">
          <div class="container">
            <div class="row align-items-center">

              <div class="col-lg-5 mr-auto text-center">
                <h3 class="heading-alt fw-300"><?php echo $scheduleHeader;?></h3><br>
                <p><?php echo $scheduleText;?></p>
                <br>

                <form action="../assets/php/sendmail.php" method="POST" data-form="mailer">

                  <input type="hidden" name="subject" value="Request demo">

                  <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="<?php echo $name;?>">
                  </div>

                  <div class="form-group">
                    <input class="form-control" type="text" name="company_name" placeholder="<?php echo $company;?>">
                  </div>

                  <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="<?php echo $email;?>">
                  </div>

                  <div class="form-group">
                    <input class="form-control" type="text" name="phone" placeholder="<?php echo $telephone;?>">
                  </div>

                  <button class="btn btn-primary btn-block" type="submit"><?php echo $scheduleDemo;?></button>
                </form>
              </div>


              <div class="col-lg-5 mx-auto">
                <img src="img/mac-1.png" alt="..." data-aos="fade-up">
              </div>

            </div>
          </div>
        </section>




    </main>
    <!-- END Main container -->



    <?php include('footer.php');?>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
