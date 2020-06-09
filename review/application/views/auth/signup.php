<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m6')); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m11')); ?>" />
        <meta name="keywords" content="<?= $this->lang->line('m12'); ?>" />
        <meta property="og:site_name" content="<?= $this->config->item('site_name') ?>" />
        <meta property="og:url" content="<?= base_url(); ?>" />
        <meta property="og:image" content="<?= base_url(); ?>assets/img/demo.png" />
        <meta property="og:description" content="<?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m11')); ?>" />
        <meta property="og:locale" content="en_US" />
        <meta name="twitter:title" content="<?= $this->config->item('site_name') ?>">
        <meta name="twitter:description" content="<?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m11')); ?>">
        <meta name="twitter:image" content="<?= base_url(); ?>assets/img/demo.png">
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
                <?= form_open('signup', ['class' => 'signup']) ?>
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
                        <h3><?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m13')); ?></h3>
                    </div>
                </div>
                <?php
                if (count($data) > 0) {
                    foreach ($data as $dat): echo $dat;
                    endforeach;
                    ?>
                    <div class="row no-mobile">
                        <div class="col-lg-12">
                            <p class="or"><span><?= $this->lang->line('m14'); ?></span></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control input username" name="username" placeholder="<?= $this->lang->line('m15'); ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input email" name="email" placeholder="<?= $this->lang->line('m16'); ?>" required>
                        </div>                
                        <div class="form-group">
                            <input type="password" name="password" class="form-control input password" placeholder="<?= $this->lang->line('m17'); ?>" required>
                        </div>
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
                    <div class="col-lg-12 col-xs-6 col-sm-6 pull-right">
                        <button type="submit" class="btn btn-all btn-signup"><?= $this->lang->line('m9'); ?></button>
                        <?php
                        if ($msg) {
                            echo $msg;
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="signup"><span><?= $this->lang->line('m45'); ?></span> <a href="<?= site_url('/') ?>"><?= $this->lang->line('m18'); ?></a></p>
                    </div>
                </div>     
                <?= form_close() ?>                                                      
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