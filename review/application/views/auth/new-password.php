<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->lang->line('m31'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php
        $favicon = get_option("favicon");
        if ($favicon): echo $favicon;
        else: echo base_url() . 'assets/img/favicon.png';
        endif;
        ?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/auth/css/style.css?ver=<?= MD_VER ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css"/>
        <?= lheads(); ?>
        <?php
        
        // Verify if the password was changed
        if ( $changed ) {
            
            echo '<meta http-equiv="refresh" content="3;url=' . base_url() . '" />';
            
        }
        
        ?>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
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
    <body<?php get_browser_class(); if ($img) { echo ' style="background-image:url(' . $img . ')"'; } ?>>
        <?php if ($video) echo $video; ?>
        <div class="container">
            <div class="col-lg-3 col-sm-4 col-xs-12 logi">
                <form action="" method="post">
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
                    <div class="row welcome">
                        <div class="col-lg-12 text-center">
                            <h3><?= $this->lang->line('m31'); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="password" class="form-control input" name="password" placeholder="<?= $this->lang->line('m33'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="password" class="form-control input" name="password2" placeholder="<?= $this->lang->line('m34'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-all btn-recover"><?= $this->lang->line('m32'); ?></button>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $msg; ?>
                            <p class="signup"><a href="<?= site_url('/') ?>"><?= $this->lang->line('m28'); ?></a></p>
                        </div>
                    </div>     
                </form>                                                  
            </div>
            <div class="col-lg-12 text-right links">
                <ul>
                    <?php if (get_option("report-bug")): ?>
                        <li><a href="<?= site_url('report-bug') ?>"><?= $this->lang->line('m21'); ?></a></li>
                    <?php endif; ?>
                    <li><a href="<?= site_url('terms-and-conditions') ?>"><?= $this->lang->line('m22'); ?></a></li>
                    <li><a href="<?= site_url('privacy-policy') ?>"><?= $this->lang->line('m23'); ?></a></li>
                </ul>
            </div>
        </div>
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?= base_url(); ?>assets/auth/js/auth.js?ver=<?= MD_VER ?>"></script>
    </body>
</html>