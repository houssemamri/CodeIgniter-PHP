<?php

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
    <link href="<?php  echo base_url(); ?>css/core.min.css" rel="stylesheet">
    <link href="<?php  echo base_url(); ?>css/thesaas.min.css" rel="stylesheet">
    <link href="<?php  echo base_url(); ?>css/style.css" rel="stylesheet">
    <style>
      input::placeholder {
        color:black !important;
      }
    </style>
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
  </head>
 <?php
    $video = "";
    $img = "";
    if (get_option("login-bg")) {
        $videoformat = ['avi', 'mp4', 'webm'];
        // check if the $options["login-bg"] url is a video
        $extension = pathinfo(get_option("login-bg"), PATHINFO_EXTENSION);
        if (in_array(@$extension, $videoformat)) {
            $video = '<video loop autoplay class="fillWidth fadeIn wow collapse in" id="video-background" poster="' . get_option("cover-bg") . '"><source src="' . get_option("login-bg") . '" type="video/' . $extension . '"></video>';
        } else {
            $img = get_option("login-bg");
        }
    }
    ?>
  <body class="mh-fullscreen bg-img center-vh p-20" style="background-image: url(<?php  echo base_url(); ?>img/Login-page.jpg);">

    <div class="card card-shadowed p-50 w-400 mb-0" style="background-color:rgba(255,255,255,0.6);max-width: 100%">
      <h5 class="text-uppercase text-center"><?php echo $login;?></h5>
<div class="row logo">
                    <div class="col-lg-12 text-center">
                        <a href="<?= base_url(); ?>" class="logourl"><img src="<?php
                            $login_logo = get_option("login-logo");
                            if ($login_logo): echo $login_logo;
                            else: echo base_url() . 'assets/auth/img/big-logo.png';
                            endif;
                            ?>" alt="<?= $this->config->item('site_name') ?>"></a>
                    </div>
                </div>
      <?= form_open('login', ['class' => 'signin']) ?>
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
          <input type="text" class="form-control input username" name="username" placeholder="<?= $this->lang->line('m15'); ?>" required>
        </div>

        <div class="form-group">
          <input type="password" class="form-control input password" name="password" placeholder="<?= $this->lang->line('m17'); ?>" required>
                            
        </div>
         <div class="form-group">
                    <div class="col-lg-12">
                        <p class="remember"><span><input type="checkbox" id="remember"></span> <span><?= $this->lang->line('m19'); ?></span></p>
                    </div>
                </div>
				
				<div class="row">
                    <?php
                    if($formobile){
                        foreach ($formobile as $mob):
                            echo $mob;
                        endforeach;                        
                    }
                    ?>
                   
                </div>
                <?php if ($signup): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="signup"><span><?= $this->lang->line('m20'); ?></span> <a href="<?= site_url('auth/signup') ?>"><?= $this->lang->line('m8') ?></a></p>
                        </div>
                    </div>
                <?php endif; ?>
        <div class="form-group flexbox py-10 pull-right">
          <a class="text-muted hover-primary fs-13"  style="color:black !important;" href="forgotPassword.php"><?php echo $loginForgot;?>?</a>
        </div>

        <div class="form-group">
		
          <button class="btn btn-bold btn-block btn-primary btn-all btn-sign" style="color:black !important;" type="submit"><?php echo $loginBtn;?></button>
        </div>
        <input type="text" hidden value="<?php echo $lang;?>" name="setLang" />
        <br />
        <ul class="list-inline text-center">
          <li class="list-inline-item"><a href="language.php?lang=fr"><img class="language" src="img/french.png" /></a></li>
          <li class="list-inline-item"><a href="language.php?lang=en"><img class="language" src="img/english.png" /></a></li>
          <li class="list-inline-item"><a href="language.php?lang=spa"><img class="language" src="img/spanish.png" /></a></li>
        </ul>
      <?= form_close() ?> 
 <div class="col-lg-12 text-right links">
                <ul>
                    <?php if (get_option("report-bug")): ?>
                        <li><a href="<?= site_url('report-bug') ?>"><?= $this->lang->line('m21'); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?= site_url('terms-and-conditions') ?>"><?= $this->lang->line('m22'); ?></a></li>
                    <li><a href="<?= site_url('privacy-policy') ?>"><?= $this->lang->line('m23'); ?></a></li>
                </ul>
            </div>


      <hr class="w-30">

    </div>




    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?= base_url(); ?>assets/auth/js/auth.js?ver=<?= MD_VER ?>"></script>

  </body>
</html>
