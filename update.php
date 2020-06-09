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

    <title>Thunder Review - Update</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">

    <!--  Open Graph Tags -->
    <meta property="og:title" content="TheSaaS">
    <meta property="og:description" content="A responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4.">
    <meta property="og:image" content="http://thetheme.io/thesaas/assets/img/og-img.jpg">
    <meta property="og:url" content="http://thetheme.io/thesaas/">
    <meta name="twitter:card" content="summary_large_image">

    <style>
      .nav-user:hover,.nav-user:active,.nav-user:visited
      {
        background-color:#cd0a62 !important;
      }
        table{
          margin:0 auto;
        }
        .test{
          font-size:28px;
          text-align: left;
          margin-left:20px;
        }
    </style>
  </head>

  <body>


    <?php include('navbar.php');
    if(strcmp($lang,'en')==0)
    {
      $updateMain = "To Modify the Software’s Text";
      $updateHeader1 = "Select the Category";
      $updateHeader2 = "Select the Text withing the Category";
      $updateHeader3 = "Modify the Text";
      $updateHeader4 = "Save the text";
      $question = "A Question?";
      $avatarText = strtoupper("Modiﬁed texts for answers linked to your Company’s Culture!");

    }
    else if(strcmp($lang,'spa')==0)
    {
      $updateMain = "Para modificar textos en el programa";
      $updateHeader1 = "Seleccione la categoría";
      $updateHeader2 = "Seleccione el texto dentro de la categoría";
      $updateHeader3 = "Modifique el texto";
      $updateHeader4 = "Guarde el texto";
      $question = "Algunas Preguntas ?";
      $avatarText = strtoupper("Textos modificados para respuestas relacionadas con la cultura de su empresa");

    }
    else
    {
      $updateMain = "Pour Modifier les Textes du Logiciel";
      $updateHeader1 = "Selectionnez la Categorie";
      $updateHeader2 = "Selectionnez le Texte au sein de la  Categorie";
      $updateHeader3 = "Modifiez le Texte";
      $updateHeader4 = "Sauvegardez le texte";
      $question = "Une Question ?";
      $avatarText = strtoupper("Des textes modiﬁés pour des Réponses liées à la culture de votre Entreprise");

    }

    if (isset($_GET['status']) && isset($_GET['type']) && isset($_GET['lang']) && isset($_GET['article'])) {
      include('optionUpdate.php');
      include('mainUpdate.php');
      include('footer.php');
    }
    else{
      header('Location: ' . './');
    }
      ?>






  </body>
</html>
