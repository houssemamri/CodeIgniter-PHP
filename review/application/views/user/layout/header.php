
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
		 <input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>"   />
    </head>
   