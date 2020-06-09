
    
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap.css"/>
        <?= custom_header(); ?>
        <?php if (($this->router->fetch_method() == 'posts') || ($this->router->fetch_method() == 'RSS_feeds') || ($this->router->fetch_method() == 'emails')): ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/user/css/bootstrap-datetimepicker.css"/>
        <?php endif; ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/morris.css" media="all"/>
		 <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/custom.css" media="all"/>
         <link href="<?= base_url(); ?>css/thesaas.css" rel="stylesheet"/>
		 <input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>"   />
