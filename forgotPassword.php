<?php include('setLanguage.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Avis Client - Forgot Password?</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
    <style>
      input::placeholder {
        color:black !important;
      }
    </style>
  </head>

  <body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url(img/Login-page.jpg);">

    <div class="card card-shadowed p-50 w-400 mb-0" style="background-color:rgba(255,255,255,0.6);max-width: 100%">
      <h5 class="text-uppercase text-center"><?php echo $loginForgot?>?</h5>
      <form class="form-transparent">
      <br />
        <?php
        if(!isset($_GET['email']))
        {?>
        <span id="status"></span>
        <div class="form-group">
          <input type="email" class="form-control" name="email" id="email1" placeholder="<?php echo $enterEmail;?>" style="color:black !important;" required>
        </div>
        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" onClick="changePassword(1);" style="color:black !important;" type="button"><?php echo $sendEmail;?></button>
        </div>
        <?php
        }
        else
        {?>
        <span id="pwdstatus"></span>
        <input type="email" id="changeEmail" value="<?php echo $_GET['email'];?>" hidden />
        <div class="form-group">
          <input type="password" id="pwd" class="form-control" autocomplete="new-password" style="color:black !important;" placeholder="Enter new password" required>
        </div>
        <div class="form-group">
          <input type="password" id="cpwd" class="form-control" autocomplete="cnew-password" style="color:black !important;" placeholder="Confirm new password" required>
          <span id="password-mismatch">Password didn't match</span>
        </div>
        <div class="form-group">
          <button class="btn btn-bold btn-block btn-primary" id="pwdbtn" onClick="changePassword(2);" style="color:black !important;" type="button"><?php echo $changePwd;?></button>
        </div>
        <?php
        } ?>

        <div class="form-group flexbox py-10" style="display:table;margin:0 auto;">

          <a class="text-muted hover-primary fs-13" style="color:black !important;" href="login.php"><?php echo $loginBtn;?></a>
        </div>
      </form>



      <hr class="w-30">

    </div>




    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        function changePassword(opt)
        {
          if(opt==1){
                  var e=document.getElementById('email1').value;
                  jQuery.ajax({
             			type: "POST",
             			url: "sendMail.php",
                   data: {email:e},
             			success: function(response){
             				  $("#status").html(response);
         			}
         			});
          }
          else{
              var p=document.getElementById('pwd').value;
              var e=document.getElementById('changeEmail').value;
              jQuery.ajax({
         			type: "POST",
         			url: "newPassword.php",
               data: {email:e,pwd:p},
         			success: function(response){
         				  $("#pwdstatus").html(response);
         			}
         			});
          }
        }
        var flag=0;
        $('#cpwd').on('keyup',function(){
          if($('#pwd').val() == $('#cpwd').val())
          {
            $('#pwdbtn').prop("disabled",false);
            $('#password-mismatch').css('display','none');
          }
          else
          {
            $('#pwdbtn').prop("disabled",true);
            $('#password-mismatch').css('display','block');
          }
        });
    </script>

  </body>
</html>
