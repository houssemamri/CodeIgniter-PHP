<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('site_name') ?> | <?= ucwords(str_replace('_',' ',$this->router->fetch_method())); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="<?php
        $favicon = get_option('favicon');
        if ($favicon): echo $favicon;
        else: echo '/assets/img/favicon.png';
        endif;
        ?>" />
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css"/>
        <?= custom_header(); ?>
        <?php if (($this->router->fetch_method() == 'posts') || ($this->router->fetch_method() == 'RSS_feeds') || ($this->router->fetch_method() == 'emails')): ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/user/css/bootstrap-datetimepicker.css"/>
        <?php endif; ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/morris.css" media="all">
		 <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom.css" media="all">
    </head>
    <body>
        <header>
            <div class="container-fluid"> <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?php
                    $main_logo = get_option('main-logo');
                    if ($main_logo): echo $main_logo;
                    else: echo base_url('assets/img/logo.png');
                    endif;
                    ?>" alt="<?= $this->config->item('site_name') ?>" width="32"></a>
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="<?php echo site_url('user/posts') ?>"><button type="button" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span><?= $this->lang->line('mu9'); ?></button></a>
                    </li>
                    <li>
                        <button type="button" class="btn btn-labeled short-menu">
                            <i class="fa fa-bars fa-lg"></i>
                        </button>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question-circle-o"></i><span class="label label-success"><?= $this->user_header['new_tickets']; ?></span></a>
                        <ul class="dropdown-menu show-tickets-lists">
                            <li><?= $this->lang->line('mu212'); ?></li>
                            <?= $this->user_header['tickets']; ?>
                            <li><a href="<?php echo site_url('user/tickets') ?>"><?= $this->lang->line('mu213'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="label label-primary"><?= $this->user_header['new_notifications']; ?></span></a>
                        <ul class="dropdown-menu notificationss">
                            <li><?= $this->lang->line('mu10'); ?></li>
                            <?= $this->user_header['notifications']; ?>
                            <li><a href="<?php echo site_url('user/notifications') ?>"><?= $this->lang->line('mu11'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="label label-danger"><?= $this->user_header['errors']; ?></span></a>
                        <ul class="dropdown-menu">
                            <li> <?= $this->lang->line('mu109'); ?>(<?= $this->user_header['errors']; ?> errors) </li>
                            <?= $this->user_header['msg']; ?>
                            <li><a href="<?php echo site_url('user/history') ?>"><?= $this->lang->line('mu11'); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> </a></li>
                </ul>
            </div>
        </header>