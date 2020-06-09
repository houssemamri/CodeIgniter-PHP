<section>
    <div class="container-fluid networks">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="panel-heading">
				
                    <h2><img src="<?php echo base_url();?>img/network/<?= ucwords($network) ?>.png" class="network_image"><?= ucwords(str_replace('_', ' ', $network)) ?></h2>
                </div>
            </div>
            <?php
            if ($msg) {
                ?>
                <script language="javascript">window.onload = function() {<?= $msg ?>}</script>
                <?php
            }
            $col = 12;
            if ( !$data ) { $data = []; }
            if ( $limit_accounts > count($data) ) {
                $limit = 1;
                $col = 11;
            }
            ?>            
            <div class="row">
                <div class="col-lg-12 main-ul">
                    <ul class="all-networks">
                        <li>
                            <div class="col-md-<?= $col; ?> clean">
                                <div class="input-group search">
                                    <input type="text" placeholder="<?= $this->lang->line('mu88'); ?>" data-network="<?= $network ?>" class="form-control search_accounts">
                                    <span class="input-group-btn search-m">
                                        <button class="btn" type="button"><i class="fa fa-binoculars"></i><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </span>
                                </div>
                            </div>
                            <?php
                            if (isset($limit)) {
                                if (file_exists(APPPATH . 'autopost/' . $network . '.php')) {
                                    include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
                                    $get = new $network;
                                    $info = $get->get_info();
                                    ?>
                                    <div class="col-md-12 clean text-right">
                                        <a href="<?= base_url(); ?>user/connect/<?= strtolower($network); ?>"<?= $popup; ?> class="btn btn-default"><span class="new-account-btn"><span style="color: <?= $info->color; ?>; margin-right:3px"><?= str_replace(' style="color:#ffffff"','',$info->icon); ?></span><span class="new-account-btn-li"> <?= $this->lang->line('mu90'); ?></span></a>

                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </li>
                        <?= $hidden ?>
                    </ul>
                    <ul class="social-accounts">
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
                        <div class="show-upgrade-purpose"><?= display_mess(95); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
                    </div>
                </div>
            <?php endif; ?>          
        </div>
    </div>
</section>
