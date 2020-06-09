<section>
    <div class="container-fluid networks">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-key"></i> <?= $this->lang->line('mu306'); ?></h2>
                </div>
            </div>
            <?php
            if ($msg) {
                ?>
                <script language="javascript">window.onload = function() {<?= $msg ?>}</script>
                <?php
            }
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="social-accounts">
                        <?php
                        if($accounts) {
                            foreach ($accounts as $account) {
                                ?>
                                <li>
                                    <div class="col-md-10 clean">
                                        <h3><?= $account->user_name ?> <span style="color: #cccccc; font-size: 12px;">(<?= ucwords(str_replace('_', ' ', $account->network_name)); ?>)</span></h3>
                                        <span class="expires"><?= $this->lang->line('mu39'); ?>: <strong><?= $account->expires ?></strong></span>
                                    </div>
                                    <div class="col-md-2 text-right clean">
                                        <a href="<?= site_url('user/connect/' . $account->network_name) ?>?account=<?= $account->network_id ?>" class="btn btn-danger renew">
                                            <?= $this->lang->line('mu307'); ?>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            }
                        } else {
                            echo '<p>' . $this->lang->line('mu308') . '</p>';
                        }
                        ?>
                    </ul>
                </div>
            </div>      
        </div>
    </div>
</section>
