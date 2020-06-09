<?php
include('setLanguage.php');
if(!isset($_SESSION['admin_status']))
{
  header('Location: ' . './');
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - Register</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>

    <body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url(img/Login-page.jpg);">




    <div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
      <h5 class="text-uppercase text-center"><?php echo $register;?></h5>

      <form class="form-type-material" action="userRegister.php" method="POST">
        <br />
        <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="<?php echo $registerName;?>">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="company" placeholder="<?php echo $registerCompany;?>">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="position" placeholder="<?php echo $registerPosition;?>">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="<?php echo $registerEmail;?>">
        </div>

        <div class="form-group">
          <input type="phone" class="form-control" name="contact" placeholder="<?php echo $registerContact;?>">
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="<?php echo $registerPassword;?>">
        </div>

        <br>
        <button class="btn btn-bold btn-block btn-primary" type="submit"><?php echo $registerBtn;?></button>
      </form>

      <hr class="w-30">
      <small class="text-center"><a href="adminProfile.php"><?php echo $registerBack;?></a></small>

    </div>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>

  </body>
</html>
