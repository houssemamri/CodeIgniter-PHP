<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= $this->config->item('site_name') ?> | <?= $this->lang->line('m43'); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="ROBOTS" content="NOINDEX" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php
        $favicon = get_option("favicon");
        if ($favicon): echo $favicon;
        else: echo base_url() . 'assets/img/favicon.png';
        endif;
        ?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css"/>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,700,900' rel='stylesheet' type='text/css'>
        <!-- Custom CSS -->
        <style>
            body
            {
                font: normal 14px/20px Merriweather, Georgia, "Times New Roman", serif;
            }
            h2
            {
                font-size: 28px;
                font-weight:700;
                margin-bottom:20px;
            }
            h3
            {
                font-size: 22px;
                font-weight:700;
            }
            p
            {
                line-height:25px;
                font-weight:400;
            }
            .col-lg-8
            {
                margin-bottom:30px;
            }
        </style>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- Page Content -->
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m42')); ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
    </body>
</html>
