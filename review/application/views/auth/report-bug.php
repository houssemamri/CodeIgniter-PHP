<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?= $this->config->item('site_name') ?> | <?= $this->lang->line('m35'); ?></title>
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
            label
            {
                font-size: 13px;
                font-weight:400;
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
            textarea
            {
                height:200px !important;
            }
            .report_subject,.report_description,.report_button
            {
                margin-top:25px;
            }
            input[type='submit']
            {
                background-color: #1BBC9B;
                border: none;
                color: #fff;
                font-weight: 400;
                margin: 0px 0px 15px;
                height: 30px;
                border-radius: 3px;
                font-size: 14px;
                padding: 5px 15px;
            }
            input[type='submit']:hover,input[type='submit']:active
            {
                background-color: #009688;	
            }
            .success
            {
                border-left: 4px solid #5C9ACF;
                background: #f2f6f9;
                width:100%;
                min-height:40px;
                line-height:40px;
                color: #458AC3;
                padding-left:10px;
                margin:0px 0px 10px;
                font-size: 13px;
            }
            .error
            {
                border-left: 4px solid #e7505a;
                background: #f2f6f9;
                width:100%;
                min-height:40px;
                line-height:40px;
                color: #e73d4a;
                padding-left:10px;
                margin:0px 0px 10px;
                font-size: 13px;
            }
        </style>
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2><?= $this->lang->line('m35'); ?></h2>
                    <p><?= str_replace('site_name',$this->config->item('site_name'),$this->lang->line('m36')); ?></p>
                    <?= form_open('report-bug') ?>
                    <div class="form-field report_subject">
                        <label for="request_subject"><?= $this->lang->line('m37'); ?></label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                    <div class="form-field report_description">
                        <label for="description"><?= $this->lang->line('m38'); ?></label>
                        <textarea name="description" class="form-control" id="description" required></textarea>
                    </div>
                    <div class="form-field report_button">
                        <div class="g-recaptcha" data-sitekey="<?= $this->config->item("captcha_site_key") ?>"></div>
                    </div>
                    <div class="form-field report_button">
                        <input type="submit" name="submit" value="<?= $this->lang->line('m39'); ?>">
                    </div>
                    <div class="form-field report_button">
                        <?= $msg ?>
                    </div>                        
                    <?= form_close() ?> 
                </div>
            </div>
        </div>
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.js"></script>
    </body>
</html>
