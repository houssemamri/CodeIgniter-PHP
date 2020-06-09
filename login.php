<?php
session_start();
if(isset($_SESSION['global_status'])){
  header('Location: ./');
}
include('setLanguage.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Login</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
      input::placeholder {
        color:black !important;
      }
    </style>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>

  <body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url(img/Login-page.jpg);">

    <div class="card card-shadowed p-50 w-400 mb-0" style="background-color:rgba(255,255,255,0.6);max-width: 100%">
      <h5 class="text-uppercase text-center"><?php echo $login;?></h5>

      <form class="form-transparent" action="userLogin.php" method="POST">
        <br />
        <?php
          if(isset($_GET['status']))
          {?>
            <div class="alert alert-warning" role="alert">
              <?php echo $loginFail;?>
            </div>
          <?php
          }
        ?>
        <br />
        <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="<?php echo $loginEmail;?>"  style="color:black !important;">
        </div>

        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="<?php echo $loginPassword;?>" style="color:black !important;">
        </div>

        <div class="form-group flexbox py-10 pull-right">
          <a class="text-muted hover-primary fs-13"  style="color:black !important;" href="forgotPassword.php"><?php echo $loginForgot;?>?</a>
        </div>

        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" style="color:black !important;" type="submit"><?php echo $loginBtn;?></button>
        </div>
        <input type="text" hidden value="<?php echo $lang;?>" name="setLang" />
        <br />
        <ul class="list-inline text-center">
          <li class="list-inline-item"><a href="language.php?lang=fr"><img class="language" src="img/french.png" /></a></li>
          <li class="list-inline-item"><a href="language.php?lang=en"><img class="language" src="img/english.png" /></a></li>
          <li class="list-inline-item"><a href="language.php?lang=spa"><img class="language" src="img/spanish.png" /></a></li>
        </ul>
      </form>



      <hr class="w-30">

    </div>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
