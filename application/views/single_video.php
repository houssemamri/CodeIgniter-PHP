<?php

foreach($video as $data){
	$video_name = $data->Name;
	$video_cat_id = $data->CID;
	$video_id = $data->VID;
	$video_user_id = $data->UID;
	$video_path = $data->Path;
	$video_description = $data->description;
	$video_image = $data->frame_image;
}
    $video_path =  $video_path;
	$video_path = ltrim($video_path, '.');
?>
<!DOCTYPE html>
<html lang="en" xmlns="w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" xmlns:og="http://ogp.me/ns#">
<head>
	<meta property="og:url"       	content="https://review-thunder.com/singlevideo/video/<?php echo $video_user_id;?>/<?php echo $video_id;?>/<?php echo $video_cat_id;?>" />
  	<meta property="og:title"       content="<?php echo $video_name;?>" />
  	<meta property="og:type"        content="website" />
  	  <!--	<meta property="og:type" content="video/mp4" >-->
	<meta property="og:description" content="<?php echo $video_description;?>" />
	<meta property="og:image"       content="<?php echo $video_image;?>" />
  	<meta property="og:video:width" content="500" />
  	<meta property="og:video"       content="https://review-thunder.com<?php echo $video_path;?>" />
  	<meta property="fb:app_id"      content="374091426531279" />
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="author" content="Review Thunder" />
    <meta name="description" content="<?php echo $video_description;?>" />
  <meta name="keywords" content="" />
 
  <title>Thunder Review </title>
 

  <!-- Styles -->
  <link href="https://review-thunder.com/css/core.min.css" rel="stylesheet" />
  <link href="https://review-thunder.com/css/thesaas.css" rel="stylesheet" />
  <link href="https://review-thunder.com/css/style.css" rel="stylesheet" />
  
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
  <link rel="apple-touch-icon" href="https://review-thunder.com/img/apple-touch-icon.png" />
  <link rel="icon" href="https://review-thunder.com/img/favicon.png" />
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
      $headerMain = "Aumente ";
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
      $headerMain = "Augmentez ";
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
  <header class="header header-inverse bg-fixed" style="background-image: url(https://review-thunder.com/img/bg-laptop.jpg)">
    <div class="container text-center">

      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">

          <?php  if(isset($_SESSION['global_status'])){ ?>
           <h1> <?php echo $_SESSION['user_name'];?> - <?php echo $video_name;?></h1>
           <?php }else{ ?>
            <h1> <?php echo $video_name;?></h1>
           <?php  } ?>
          <!--<p class="fs-18 opacity-100" id="subHeader">Manage Videos</p>-->
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
          
             
                    <div class="" id="">
                      <div class="row mt-100">
                        
                        <div class="col-md-12 text-center">
                         
                          <h3>
                            <?php echo $video_name;?>
                          </h3>
                         
                          <video width="800" height="500" id="video-element" controls  >
                            <source src="https://review-thunder.com/<?php echo $video_path;?>" type="video/mp4"/>
                          </video>
                          
                         <canvas id="canvas-element" style="display: none"></canvas>
						 <img id="my-screenshot" />
						  <h3><?php echo $share_videos;?></h3>
						  <!--Genrating Social Media Share Link-->
                          <!-- Your share button code -->
						  <div class="fb-share-button" 
						    data-href="https://review-thunder.com/singlevideo/video/<?php echo $video_user_id;?>/<?php echo $video_id;?>/<?php echo $video_cat_id;?>" 
						    data-layout="button_count">
						  </div>
                        </div>
                       
                      </div>
                    </div>
              
        
        <!--
               <a id="download-link" href="#">Download Thumbnail</a>-->
         
            
       




          </div>
      



      </div>
    </section>

  </main>
  <!-- END Main container -->









  <!-- Scripts -->
  <script src="https://review-thunder.com/assets/js/capture-video-frame.js"></script>
  <script src="https://review-thunder.com/assets/js/page.min.js"></script>
  <script src="https://review-thunder.com/assets/js/script.js"></script>
  <script src="https://review-thunder.com/js/core.min.js"></script>
  <script src="https://review-thunder.com/js/thesaas.min.js"></script>
  <script src="https://review-thunder.com/js/script.js"></script>
  <script src="https://review-thunder.com/js/select2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>


  <script>

    	    $(document).ready(function(){
			    	
			  $('[data-toggle="tooltip"]').tooltip(); 
			});


  </script>
 
  <?php include('footer.php');?>
 
</body>

</html>