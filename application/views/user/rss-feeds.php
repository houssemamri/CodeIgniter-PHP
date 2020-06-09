<section>
    <div class="container-fluid rss">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-rss"></i> <?= $this->lang->line('mu4'); ?> <?php if(($data?count($data):0) < $rss_limit): ?><a href="<?= base_url(); ?>user/rss-feeds/new-feed" class="pull-right"><?= $this->lang->line('mu71'); ?></a><?php endif; ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="feeds-rss">
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                    </ul>
                    <img src="<?= base_url(); ?>assets/img/pageload.gif" class="pull-right pageload">
                </div>
            </div>
            <?php if (isset($options["plans-notice"])): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="show-upgrade-purpose"><?= display_mess(96); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
                    </div>
                </div> 
            <?php endif; ?>
        </div>
    </div>
</section>
