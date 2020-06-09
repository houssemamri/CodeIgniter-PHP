<section>
    <div class="container-fluid plans">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6 fl">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel-heading">
                                <h2><i class="fa fa-clone"></i> <?= $this->lang->line('ma17'); ?> <a href="<?php echo site_url('admin/plans') ?>" class="pull-right"><?= $this->lang->line('ma18'); ?></a></h2>
                            </div>
                        </div> 
                        <div class="row plans-list">   
                            <div class="col-lg-12">
                                <ul class="show-plans">
                                </ul>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 fr">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel-heading details">
                                <h2><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?= $this->lang->line('ma18'); ?><span></span></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <?= form_open('admin/users', ['class' => 'create-plan']) ?>
                                <div class="form-group">
                                    <input class="new-message form-control plan_name" type="text" placeholder="<?= $this->lang->line('ma19'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control plan_price" type="number" min="0.00" placeholder="<?= $this->lang->line('ma20'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control currency_sign" type="text" placeholder="<?= $this->lang->line('ma21'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control currency_code" type="text" placeholder="<?= $this->lang->line('ma22'); ?>" required>
                                </div>                        
                                <div class="form-group">
                                    <input class="new-message form-control allowed_accounts" type="number" min="0" placeholder="<?= $this->lang->line('ma23'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control allowed_rss" type="number" min="0" placeholder="<?= $this->lang->line('ma24'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control accounts_number" type="number" min="0" placeholder="<?= $this->lang->line('ma25'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control limit_posts_month" type="number" min="0" placeholder="<?= $this->lang->line('ma26'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control limit_videos" type="number" min="0" placeholder="<?= $this->lang->line('ma149'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control limit_images" type="number" min="0" placeholder="<?= $this->lang->line('ma148'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="new-message form-control features_plan" rows="8" placeholder="<?= $this->lang->line('ma27'); ?>" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="new-message form-control period_plan" type="number" min="0" onkeydown="if (this.value.length == 8) return false;" placeholder="<?= $this->lang->line('ma28'); ?>" required>
                                </div>
                                <?php if (get_option('email_marketing')): ?>
                                    <div class="form-group">
                                        <input class="new-message form-control number_emails" type="number" placeholder="<?= $this->lang->line('ma137'); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <span class="side-tab" data-target="#tab1" data-toggle="tab" role="tab" aria-expanded="false">
                                            <div class="panel-heading" role="tab" id="headingOne"data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h4 class="panel-title"><?= $this->lang->line('ma179'); ?></h4>
                                            </div>
                                        </span>

                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <ul class="plan_networks">
                                                <?php
                                                if ( $networks ) {
                                                    foreach ( $networks as $network ) {
                                                        echo $network;
                                                    }
                                                }
                                                ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-control teams">
                                        <option value="0"><?= $this->lang->line('ma177'); ?></option>
                                        <option value="1"><?= $this->lang->line('ma178'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control plan-status">
                                        <option value="0"><?= $this->lang->line('ma180'); ?></option>
                                        <option value="1"><?= $this->lang->line('ma181'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-labeled btn-danger pull-left delete-plan display-none" data-plan=""><?= $this->lang->line('ma29'); ?></button> <p class="pull-left confirm"><?= $this->lang->line('ma30'); ?> <a href="#" class="yes"><?= $this->lang->line('ma31'); ?></a><a href="#" class="no"><?= $this->lang->line('ma32'); ?></a></p>
                                    <button type="submit" class="btn btn-labeled btn-primary pull-right save-plan"><?= $this->lang->line('ma33'); ?></button>
                                </div>
                                <div class="form-group alert-msg"></div>
                                <?= form_close() ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="panel-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>