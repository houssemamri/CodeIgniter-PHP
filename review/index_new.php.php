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

    <title>Thunder Review - Home</title>

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
    if(strcmp($lang,'en')==0)
    {
      $headerMain = "Increase your";
      $header1 = "Sales";
      $header2 = "Customer's Loyalty";
      $header3 = "Trust in your Company";
      $discover = "Discover";
      $contentMain = "Review Thunder, The Perfect tool";
      $contentHeader1 = "To Answer to Reviews";
      $contentHeader2 = "To Increase Your Reviews";
      $contentHeader3 = "To Promote Your Reviews";
      $Answers = "Answers";
      $Increase = "Increase";
      $Promotion = "Promotion";
      $Personalise = "Personalise";
      $subHeader1 = "EVERYTHING TO INCREASE YOUR RANKINGS ON <br /> REVIEW SITES";
      $subText1 = "From Answering to your Reviews to helping you increase them, Review Thunder is full of useful features. <br /> It would be a Pleasure to realise a Demo or to Give you Explanations";
      $imageHeader1 = "Be The First";
      $imageHeader2 = "Skyrocket Your Sells";
      $imageHeader3 = "Smell The Air";
      $imageText1 = "Increase your Ranking on <br /> Review Websites thanks <br /> to our different Tools";
      $imageText2 = "Nowadays, 90% of potential <br /> customers check your online <br /> reviews. Be sure to be picked";
      $imageText3 = "Check your most common <br /> Criticisms & Personalise <br /> everything to stay close from <br /> your clients.";
      $reviewHeader = "User Reviews";
      $reviewText = "Join our Happy Customers and start improving your client’s Loyalty";
      $getitnow = "GET IT NOW";
      $getitnowText = "If you have visited the other pages and you have made your decision to purchase this template, go on and press the following button and get a license in less than a minute.";
      $purchase = "Purchase for &euro;60";
      $purchaseSub = "or purchase an Extended License";

    }
    else if(strcmp($lang,'spa')==0)
    {
      $headerMain = "Aumente sus";
      $header1 = "Sus ventas";
      $header2 = "La fidelidad de sus clientes";
      $header3 = "Su notoriedad";
      $discover = "Descubra";
      $contentMain = "ReviewThunder, la herramienta perfecta para";
      $contentHeader1 = "Responder a sus calificaciones";
      $contentHeader2 = "Aumentar sus calificaciones";
      $contentHeader3 = "Promover sus calificaciones";
      $Answers = "Responder";
      $Increase = "Aumentar";
      $Promotion = "Promover";
      $Personalise = "Personalizar";
      $subHeader1 = "TODO PARA AUMENTAR SU CLASIFICACIÓN EN LOS SITIOS DE <br /> CALIFICACIONES DE LOS CLIENTES";
      $subText1 = "De la respuesta a las calificaciones pasando por una tentativa de aumento de estos últimos, ReviewThunder está lleno<br /> de funciones útiles. Sería un placer hacerle una Demostración o darle algunas explicaciones.";
      $imageHeader1 = "Sea el primero";
      $imageHeader2 = "Desarrolle sus ventas";
      $imageHeader3 = "Aumente sus posibilidades";
      $imageText1 = "Mejore su clasificación en <br /> los sitios de calificaciones";
      $imageText2 = "o	Hoy en día, 90% de los clientes<br /> verifican las calificaciones<br />en Internet. ¡Aumente sus <br /> posibilidades de vender!";
      $imageText3 = "Vigile las críticas más recientes y <br /> modifique el conjunto del programa<br />para mantener lo más<br />cerca posible de sus clientes.";
      $reviewHeader = "Clientes Felices";
      $reviewText = "Únase a nuestros clientes satisfechos y comience  mejorar sus calificaciones";
      $getitnow = "ÚNASE A NOSOTROS";
      $getitnowText = "Descubra los paquetes de nuestro programa y nuestros servicios de reputación en línea con el fin de aumentar sus ventas y la fidelidad de sus clientes.";
      $purchase = "A partir de 60 &euro;";
      $purchaseSub = "O compre una Licencia Extendida";
    }
    else
    {
      $headerMain = "Augmentez vos";
      $header1 = "Vos Ventes";
      $header2 = "Votre Fidélité Client";
      $header3 = "Votre Notoriété";
      $discover = "DÉCOUVERTE";
      $contentMain = "Review Thunder, L’Outil parfait pour";
      $contentHeader1 = "Répondre à vos Avis";
      $contentHeader2 = "Accroitre vos Avis";
      $contentHeader3 = "Promouvoir vos Avis";
      $Answers = "Répondre";
      $Increase = "Accroitre";
      $Promotion = "Promouvoir";
      $Personalise = "Personaliser";
      $subHeader1 = "TOUT POUR ACCROITRE VOS CLASSEMENTS SUR LES<br /> SITES D’AVIS CLIENTS";
      $subText1 = "De la Réponse à vos Avis à une tentative d’Augmentation de ces derniers,  Review Thunder est plein de Fonctionnalités utiles.<br /> Cela serait un plaisir de vous faire une Démonstration ou de vous donner des Explications";
      $imageHeader1 = "Soyez le Premier";
      $imageHeader2 = "Développez vos Ventes";
      $imageHeader3 = "Gardez une Oreille au Sol";
      $imageText1 = "Améliorez votre <br /> Classement sur les Sites d’Avis";
      $imageText2 = "De nos Jours, 90% des Clients<br /> vérifient les Avis sur internet.<br /> Augmentez vos Chances de Vendre !";
      $imageText3 = "Surveillez les Critiques les plus <br /> fréquentes et modifiez <br /> l’ensemble du logiciel pour <br /> rester au plus près de vos Clients.";
      $reviewHeader = "Des Clients Heureux";
      $reviewText = "Rejoignez nos Clients Satisfaits & commencez à Améliorer vos Avis clients";
      $getitnow = "REJOIGNEZ NOUS";
      $getitnowText = "Découvrez les Packages de notre Logiciel & nos Services de E-Reputation afin d’Augmenter vos Ventes & la Fidélité de vos Clients.";
      $purchase = "A Partir de 60&euro;";
      $purchaseSub = "Ou Achetez une Licence Étendue";
    }

    ?>

    <!-- Header -->
    <header class="header text-white" style="background-image: url(img/background.jpeg)" data-overlay="8">
        <div class="container text-center">

          <div class="row">
            <div class="col-lg-8 mx-auto">

              <h1 class="text-white">
                <table>
                  <tr>
                    <td><?php echo $headerMain;?></td>
                    <td>
                    <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $header1;?>,<?php echo $header2;?>,<?php echo $header3;?>" data-type-speed="80"></span>
                  </td>
                  </tr>
                </table>

              </h1>

              <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white text-uppercase" href="#main"><?php echo $discover;?></a>

            </div>
          </div>

        </div>
    </header><!-- /.header -->

    <!-- END Header -->

    <!-- END Header -->
    <!-- Main container -->
    <main class="main-content" id="main">
      <h4 class="text-center mt-50">
        <table>
          <tr>
            <td><?php echo $contentMain;?></td>
            <td>
            <span class="fw-800 pl-2 text-primary" data-typing="<?php echo $contentHeader1;?>,<?php echo $contentHeader2;?>,<?php echo $contentHeader3;?>" data-type-speed="80"></span>

          </tr>
        </table>
      </h4>
      <section class="section" id="section-htab">
        <div class="container">

          <div class="text-center">
            <ul class="nav nav-outline nav-round">
              <li class="nav-item w-140">
                <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $Answers;?></a>
              </li>
              <li class="nav-item w-140">
                  <a class="nav-link" data-toggle="tab" href="#home1"><?php echo $Increase;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link" data-toggle="tab" href="#3"><?php echo $Promotion;?></a>
              </li>
              <li class="nav-item w-140 hidden-sm-down">
                <a class="nav-link" data-toggle="tab" href="#4"><?php echo $Personalise;?></a>
              </li>
            </ul>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="home">
              Test1
            </div>
            <div class="tab-pane fade" id="home1">
              Test2
            </div>
          </div>



        </div>
      </section>
      <div class="container">
        <div class="text-center">
          <h5><?php echo $subHeader1;?></h5>
          <p class="mt-30"><?php echo $subText1;?></p>
          <div class="row mt-50 text-center">
            <div class="col-md-4">
              <img src="img/home-1.png" alt="">
              <p class="mt-20"><?php echo $imageHeader1;?></p>
              <p><?php echo $imageText1;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/home-2.png" alt="">
              <p class="mt-20"><?php echo $imageHeader2;?></p>
              <p><?php echo $imageText2;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/home-3.png" alt="">
              <p class="mt-20"><?php echo $imageHeader3;?></p>
              <p><?php echo $imageText3?></p>
            </div>
          </div>
        </div>
      </div>
      <section class="section">
        <div class="container">
          <header class="section-header">
            <h2><?php echo $reviewHeader;?></h2>
            <hr>
            <p class="lead"><?php echo $reviewText;?></p>
          </header>


          <div class="slider-t" data-provide="slider" data-dots="true" data-autoplay="false" data-slides-to-show="2">
            <div class="p-15">
              <div class="card shadow-3">
                <div class="card-body p-12">
                  <div class="rating mb-3">
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                  </div>

                  <p class="text-quoted mb-5">Some quick example text to build on the card title and make up the bulk of the card's content. Some quick example text to build on.</p>
                  <div class="media align-items-center pb-0">
                    <div class="media-body lh-1">
                      <div class="fw-400 small-1 mb-1">Maryam Amiri</div>
                      <small class="text-lighter">@maryami</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-15">
              <div class="card shadow-3">
                <div class="card-body p-12">
                  <div class="rating mb-3">
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                  </div>

                  <p class="text-quoted mb-5">Some quick example text to build on the card title and make up the bulk of the card's content. Some quick example text to build on.</p>
                  <div class="media align-items-center pb-0">
                    <div class="media-body lh-1">
                      <div class="fw-400 small-1 mb-1">Hossein Shams</div>
                      <small class="text-lighter">@shamsoft</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-15">
              <div class="card shadow-3">
                <div class="card-body p-12">
                  <div class="rating mb-3">
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                  </div>

                  <p class="text-quoted mb-5">Some quick example text to build on the card title and make up the bulk of the card's content. Some quick example text to build on.</p>
                  <div class="media align-items-center pb-0">
                    <div class="media-body lh-1">
                      <div class="fw-400 small-1 mb-1">Sarah Johns</div>
                      <small class="text-lighter">@sarah</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="p-15">
              <div class="card shadow-3">
                <div class="card-body p-12">
                  <div class="rating mb-3">
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                    <label class="fa fa-star active"></label>
                  </div>

                  <p class="text-quoted mb-5">Some quick example text to build on the card title and make up the bulk of the card's content. Some quick example text to build on.</p>
                  <div class="media align-items-center pb-0">
                    <div class="media-body lh-1">
                      <div class="fw-400 small-1 mb-1">John Hernandez</div>
                      <small class="text-lighter">@jhez</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </section>
      <section class="section text-white py-60" style="background-image: linear-gradient(120deg, #fccb90 0%, #d57eeb 100%);">
        <div class="container">
          <header class="section-header">
            <h2 class="display-4 fw-400 text-white"><?php echo $getitnow;?></h2>
            <hr>
            <p class="lead-2"><?php echo $reviewText;?></p>
          </header>

          <p class="text-center">
            <a class="btn btn-xl btn-round btn-light w-250" href="contact.php"><?php echo $purchase;?></a><br>
            <small><a class="text-white opacity-80" href="javascript:;"><?php echo $purchaseSub;?></a></small>
          </p>
        </div>
      </section>
    </main>
    <!-- END Main container -->



    <?php include('footer.php');?>




    <!-- Scripts -->
    <script src="assets/js/page.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
