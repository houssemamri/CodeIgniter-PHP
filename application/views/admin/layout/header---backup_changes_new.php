
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
		 <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom.css" media="all">
		 <input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>"   />
    </head>
   