<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title><?php echo $title;?></title>

    <!-- Styles -->
    <link href="<?php echo base_url();?>assets/css/page.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?php echo base_url();?>assets/img/apple-touch-icon.png">
    <link rel="icon" href="<?php echo base_url();?>assets/img/favicon.png">
  </head>
  <?php
    //echo $_SESSION['language1'];
    if(strcmp($_SESSION['language1'],'en')==0){
        $home="Home";
        $article="Answer Reviews";
        $database="Database";
        $add="Add Data";
        $update="Update Data";
        $advice="Advices";
        $support="Support";
        $contact="Contact";
        $profile="Profile";
        $account="Account";
        $logout="Logout";
        $login="Conectarse";
        $manageAcc="Manage Account(s)";
        $$manageEmailList = "Manage Email List";
    }
    else if(strcmp($_SESSION['language1'],'spa')==0){
        $home="Pàgina Principal";
        $article="Respuestas";
        $database="Datos";
        $add="Adición de Posibilidades";
        $update="Modificación de Posibilidades";
        $advice="Consejos";
        $support="Ayuda";
        $contact="Contacto";
        $profile="Perfil";
        $account="Cuenta";
        $manageAcc="Gestionar Cuenta";
        $logout="Cerrar sesión";
        $login="Conectarse";
        $$manageEmailList = "Gestionar Lista de Email";
    }
    else
    {
      $home="Accueil";
      $article="Répondre aux Avis";
      $database="Données";
      $add="Ajout Données";
      $update="Modification Données";
      $advice="Conseils";
      $support="Support";
      $contact="Contact";
      $profile="Profil";
      $account="Compte";
      $manageAcc="Gestion Comptes";
      $logout="Se Déconnecter";
      $login="Se Connecter";
      $$manageEmailList = "Gérer Listes d’Emails";
    }
  ?>

  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="fixed">
      <div class="container">

        <div class="navbar-left">
          <button class="navbar-toggler" type="button">&#9776;</button>
          <a class="navbar-brand" href="http://review-thunder.com">
            <img class="logo-dark" src="<?php echo base_url();?>assets/img/logo-dark.png" alt="logo">
            <img class="logo-light" src="<?php echo base_url();?>assets/img/logo-light.png" alt="logo">
          </a>
        </div>

        <section class="navbar-mobile">
          <span class="navbar-divider d-mobile-none"></span>

          <ul class="nav nav-navbar ml-auto">
            <li class="nav-item"><a class="nav-link" href="http://review-thunder.com"><?php echo $home;?></a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo base_url();?>">Blog</a></li>
            <li class="nav-item"><a class="nav-link" href="http://review-thunder.com/article.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $article;?></a></li>
            <li class="nav-item">
              <a class="nav-link" href="#">Database <span class="arrow"></span></a>
              <nav class="nav">
                <a class="nav-link" href="http://review-thunder.com/upload.php"><?php echo $add;?></a>
                <a class="nav-link" href="http://review-thunder.com/update.php"><?php echo $update;?></a>
              </nav>
            </li>
            <li class="nav-item"><a class="nav-link" href="http://review-thunder.com/support.php"><?php echo $support;?></a></li>
            <?php
                if(isset($_SESSION['admin_status'])){?>
                 <li class="nav-item"><a class="nav-link" href="http://review-thunder.com/adminProfile.php">Admin Panel</a></li>
              <?php
                }
             ?>
             <li class="nav-item">
               <a class="nav-link" href="#"><?php echo $_SESSION['user_name'];?> <span class="arrow"></span></a>
               <nav class="nav">
                 <a class="nav-link" href="http://review-thunder.com/profile.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $account;?></a>
                 <a class="nav-link" href="http://review-thunder.com/masterAcc.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $manageAcc;?></a>
                 <a class="nav-link" href="http://review-thunder.com/profile.php?id=<?php echo $_SESSION['user_id'];?>&type=1"><?php echo $manageEmailList;?></a>
                 <a class="nav-link" href="http://review-thunder.com/profile.php?id=<?php echo $_SESSION['user_id'];?>&type=2"><?php echo $sendEmails;?></a>
                 <a class="nav-link" href="http://review-thunder.com/logout.php"><?php echo $logout;?></a>
               </nav>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#">Language <span class="arrow"></span></a>
               <nav class="nav">
                   <a class="nav-link" href="<?php echo base_url();?>Home/language?lang=fr"><img class="language" src="<?php echo base_url();?>assets/img/french.png" /> Français</a>
                   <a class="nav-link" href="<?php echo base_url();?>Home/language?lang=en"><img class="language" src="<?php echo base_url();?>assets/img/english.png" /> English</a>
                   <a class="nav-link" href="<?php echo base_url();?>Home/language?lang=spa"><img class="language" src="<?php echo base_url();?>assets/img/spanish.png" /> Espanol</a>
               </nav>
             </li>
          </ul>
        </section>

      </div>
    </nav><!-- /.navbar -->
