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

    <title>Thunder Review - Shop</title>

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
      .product-detail ul li ul{
        list-style-type: circle;
      }
      .pswp{
        display: none;
      }
    </style>
  </head>

  <body>


    <?php include('navbar.php');
    if(strcmp($lang,'en')==0)
    {
      $headerMain = "Details of our";
      $header1 = "Software’s Packages";
      $header2 = "EReputation Packages";
      $headerSubText = "Everything is included in order to Increase your Online Sales, your Customer’s Loyalty and your Notoriety";
      $question = "A Question?";
      $contentMain = "Review Thunder, The Perfect tool";
      $contentHeader1 = "To Answer to Reviews";
      $contentHeader2 = "To Increase Your Reviews";
      $contentHeader3 = "To Promote Your Reviews";
      $Answers = "Answers";
      $Increase = "Increase";
      $Promotion = "Promotion";
      $Personalise = "Personalise";
      $subHeader1 = "So Intuitive and Simple";
      $subText1 = "We are so Exited to see the Results which our Software will enable you to Reach!";
      $imageHeader1 = "Answer";
      $imageHeader2 = "Review Analysis";
      $imageHeader3 = "Personalisation";
      $imageHeader4 = "Promotion";
      $imageHeader5 = "Increase of Your Reviews";
      $imageHeader6 = "Advice and Support";
      $imageText1 = "Possibility to Prepare and Publish<br />your Answer on the Main<br /> Review’s Websites.";
      $imageText2 = "Review analysis tool in order to<br />determine the main positives or<br />Negatives Criticisms.";
      $imageText3 = "All the Texts and promotional<br />features are personalisable<br />inside this software..";
      $imageText4 = "Tools to promote your<br />Establishment and your Online<br />Reviews";
      $imageText5 = "Numerous tools availables in order to<br />increase the number of Reviews<br />present online.";
      $imageText6 = "An Advising and Blogging plat-form made<br />to help you in the management of your<br />Different Reviews.";
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
      $question = "Descubra";
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
      $question = "DÉCOUVERTE";
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
    <header class="header text-white" style="background-image: url(img/15.jpg)" data-overlay="8">
        <div class="container text-center">

          <div class="row">
            <div class="col-lg-8 mx-auto">

              <h1 class="text-white">
                <table>
                  <tr>
                    <td><?php echo $headerMain;?></td>
                    <td>
                    <ul class="list-inline text-primary test">
                      <li><?php echo $header1;?></li>
                      <li><?php echo $header2;?></li>
                    </ul>
                  </td>
                  </tr>
                </table>

              </h1>
              <p><?php echo $headerSubText;?></p>

              <hr class="w-60px my-7">

                <a class="btn btn-lg btn-round btn-white text-uppercase" href="#"><?php echo $question;?></a>

            </div>
          </div>

        </div>
    </header><!-- /.header -->

    <!-- END Header -->

    <!-- END Header -->
    <!-- Main container -->
    <main class="main-content">
      <section class="section bg-gray">
        <div class="container">
          <div class="row gap-y">

            <div class="col-md-3">
              <h2>All your Online Needs at only a click away</h2>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-1.png" alt="product">
                    </a>

                    <div class="product-detail">
                        <ul class="list-inline text-primary">
                          <li>Answering Reviews</li>
                          <li>Fully Customizable</li>
                          <li>Fully Customizable</li>
                          <li>Increase Your Reviews</li>
                          <li>Promotion of Reviews</li>
                        </ul>
                        <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>


                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-2.png" alt="product">
                    </a>

                    <div class="product-detail">
                        <ul class="list-inline text-primary">
                          <li>Answering Reviews</li>
                          <li>Fully Customizable</li>
                          <li>Fully Customizable</li>
                          <li>Increase Your Reviews</li>
                          <li>Promotion of Reviews</li>
                        </ul>
                        <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>


                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-3.png" alt="product">
                    </a>

                    <div class="product-detail">
                        <ul class="list-inline text-primary">
                          <li>Answering Reviews</li>
                          <li>Fully Customizable</li>
                          <li>Fully Customizable</li>
                          <li>Increase Your Reviews</li>
                          <li>Promotion of Reviews</li>
                        </ul>
                        <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-4.png" alt="product">
                    </a>

                    <div class="product-detail">
                        <ul class="list-inline text-primary">
                          <li>Answering Reviews</li>
                          <li>Fully Customizable</li>
                          <li>Fully Customizable</li>
                          <li>Increase Your Reviews</li>
                          <li>Promotion of Reviews</li>
                        </ul>
                        <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-5.png" alt="product">
                    </a>

                    <div class="product-detail">
                      <ul class="list-inline">
                        <li class="text-primary">Creation of Accounts</li>
                        <li>
                          <ul class="list-inline">
                            <li>Main Social Networks</li>
                            <li>Personalisation and Setting</li>
                          </ul>
                        </li>
                        <li class="text-primary">Networks Management for 3h per Month</li>
                        <li>
                          <ul class="list-inline">
                            <li>Definition of Editorial Line</li>
                            <li>Publication of SEO Optimised Content</li>
                            <li>Animation of Networks and Communities</li>
                            <li>Realisation of any other online task if fitting in the remaining time</li>
                            <li>Contract without Commitment</li>
                          </ul>
                        </li>

                      </ul>
                      <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>


                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-6.png" alt="product">
                    </a>

                    <div class="product-detail">
                      <ul class="list-inline">
                        <li class="text-primary">Creation of Accounts</li>
                        <li>
                          <ul class="list-inline">
                            <li>Main Social Networks</li>
                            <li>Personalisation and Setting</li>
                          </ul>
                        </li>
                        <li class="text-primary">Networks Management for 5h per Month</li>
                        <li>
                          <ul class="list-inline">
                            <li>Definition of Editorial Line</li>
                            <li>Publication of SEO Optimised Content</li>
                            <li>Animation of Networks and Communities</li>
                            <li>Realisation of any other online task if fitting in the remaining time</li>
                            <li>Contract without Commitment</li>
                          </ul>
                        </li>

                      </ul>
                      <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>


                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-7.png" alt="product">
                    </a>

                    <div class="product-detail">
                      <ul class="list-inline">
                        <li class="text-primary">Creation of Accounts</li>
                        <li>
                          <ul class="list-inline">
                            <li>Main Social Networks</li>
                            <li>Personalisation and Setting</li>
                          </ul>
                        </li>
                        <li class="text-primary">Networks Management for 7h per Month</li>
                        <li>
                          <ul class="list-inline">
                            <li>Definition of Editorial Line</li>
                            <li>Publication of SEO Optimised Content</li>
                            <li>Animation of Networks and Communities</li>
                            <li>Realisation of any other online task if fitting in the remaining time</li>
                            <li>Contract without Commitment</li>
                          </ul>
                        </li>

                      </ul>
                      <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="product-3 mb-3">
                    <a class="product-media" href="item.html">
                      <img src="img/shop-8.png" alt="product">
                    </a>

                    <div class="product-detail">
                      <ul class="list-inline">
                        <li class="text-primary">Creation of Accounts</li>
                        <li>
                          <ul class="list-inline">
                            <li>Main Social Networks</li>
                            <li>Personalisation and Setting</li>
                          </ul>
                        </li>
                        <li class="text-primary">Networks Management for 11h per Month</li>
                        <li>
                          <ul class="list-inline">
                            <li>Definition of Editorial Line</li>
                            <li>Publication of SEO Optimised Content</li>
                            <li>Animation of Networks and Communities</li>
                            <li>Realisation of any other online task if fitting in the remaining time</li>
                            <li>Contract without Commitment</li>
                          </ul>
                        </li>

                      </ul>
                      <button type="button" class="btn btn-round btn-outline-primary">Contact Us</button>
                    </div>
                  </div>
                </div>






              </div>
            </div>

          </div>



        </div>
      </section>

      <div class="container">
        <div class="text-center">
          <h3 class="mt-70"><?php echo $subHeader1;?></h3>
          <p class="mt-30"><?php echo $subText1;?></p>
          <img src="img/shop-tab.png" alt="" />
          <div class="row mt-50 text-center">
            <div class="col-md-4">
              <img src="img/shop-img-1.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader1;?></p>
              <p><?php echo $imageText1;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/shop-img-3.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader3;?></p>
              <p><?php echo $imageText3;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/shop-img-5.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader5;?></p>
              <p><?php echo $imageText5?></p>
            </div>
            <div class="col-md-4">
              <img src="img/shop-img-2.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader2;?></p>
              <p><?php echo $imageText2;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/shop-img-4.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader4;?></p>
              <p><?php echo $imageText4;?></p>
            </div>
            <div class="col-md-4">
              <img src="img/shop-img-6.png" alt="">
              <p class="mt-20" style="font-size:18px;"><?php echo $imageHeader6;?></p>
              <p><?php echo $imageText6;?></p>
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
