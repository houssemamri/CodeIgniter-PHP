<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $this->config->item('site_name') ?> | <?= str_replace('_', ' ', ucfirst($this->router->fetch_method())) ?></title>
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
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/admin/css/style.css?ver=<?= MD_VER ?>" media="all"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/morris.css" media="all">
        <?php if ($this->router->fetch_method() == 'notifications'): ?>
            <link href="<?= base_url(); ?>assets/admin/summernote/dist/summernote.css" rel="stylesheet">
        <?php endif; ?>
    </head>
    <body>
        <header>
            <div class="container-fluid"> <a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?php
                    $main_logo = get_option('main-logo');
                    if ($main_logo): echo $main_logo;
                    else: echo base_url() . '/assets/img/logo.png';
                    endif;
                    ?>" alt="<?= $this->config->item('site_name') ?>" width="32"></a>
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="<?php echo site_url('admin/notifications') ?>" class="btn btn-labeled btn-primary"><span class="btn-label"><i class="fa fa-plus"></i></span><?= $this->lang->line('ma8'); ?></a>
                    </li>
                    <li>
                        <button type="button" class="btn btn-labeled short-menu"> <i class="fa fa-bars fa-lg"></i> </button>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="<?php echo site_url('admin/tickets') ?>"><i class="fa fa-question-circle-o"></i><span class="label label-success"><?= $this->admin_header['all_tickets'] ?></span></a>
                    </li>  
                    <li class="dropdown">
                        <a href="<?php echo site_url('admin/auto-publish') ?>"><i class="fa fa-calendar-check-o"></i><span class="label label-danger"><?= $this->admin_header['all_scheduled'] ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> </a>
                    </li>
                </ul>
            </div>
        </header>