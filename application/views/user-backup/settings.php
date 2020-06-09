<section>
    <div class="container-fluid settings">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-cog"></i> <?= $this->lang->line('mu7'); ?><?php if ( plan_feature( 'teams' ) ) : ?><a href="<?= site_url('user/team') ?>" class="pull-right"><?= $this->lang->line('mu314'); ?></a><?php endif; ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <div class="widget-toolbar">
                                <ul class="nav nav-tabs">
                                    <li class="active"> <a data-toggle="tab" href="#general" aria-expanded="true"><?= $this->lang->line('mu73'); ?></a> </li>
                                    <li class=""> <a data-toggle="tab" href="#advanced" aria-expanded="false"><?= $this->lang->line('mu74'); ?></a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="tab-content">
                                    <div id="general" class="tab-pane active">
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu75'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="email_notifications" name="email_notifications" <?php if (isset($options["email_notifications"])) echo 'checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="email_notifications"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu76'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="error_notifications" name="error_notifications" <?php if (isset($options["error_notifications"])) echo 'checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="error_notifications"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu77'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="disable_preview" name="disable_preview" <?php if (isset($options["disable_preview"])) echo 'checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="disable_preview"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu214'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="notification_tickets" name="notification_tickets" <?php if (isset($options["notification_tickets"])) echo 'checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="notification_tickets"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="advanced" class="tab-pane">
                                        <?= form_open('user/settings', ['class' => 'advanced-settings']) ?>
                                        <div class="list-group">
                                            <div class="list-group-item" id="input-fields">
                                                <div class="form-group">
                                                    <label for="basic-input"><?= $this->lang->line('mu78'); ?></label>
                                                    <input class="form-control" value="<?= $udata["username"] ?>" disabled="disabled">
                                                </div>
                                                <div class="form-group">
                                                    <label for="basic-input"><?= $this->lang->line('mu79'); ?></label>
                                                    <input class="form-control email" type="email" required="required" value="<?= $udata["email"] ?>" placeholder="<?= $this->lang->line('mu82'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="basic-input"><?= $this->lang->line('mu80'); ?></label>
                                                    <input class="form-control password" type="password" placeholder="<?= $this->lang->line('mu83'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="basic-input"><?= $this->lang->line('mu81'); ?></label>
                                                    <input class="form-control rpassword" type="password" placeholder="<?= $this->lang->line('mu84'); ?>">
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-6 col-sm-6 col-xs-6 clean">
                                                        <button type="button" class="btn btn-danger pull-left delete-account"><?= $this->lang->line('mu85'); ?></button>
                                                        <p class="pull-left confirm"><?= $this->lang->line('mu68'); ?> <a href="#" class="delete-user-account yes"><?= $this->lang->line('mu69'); ?></a><a href="#" class="no"><?= $this->lang->line('mu70'); ?></a></p>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-6 clean">
                                                        <button type="submit" class="btn btn-success pull-right"><?= $this->lang->line('mu86'); ?></button>
                                                    </div>
                                                </div>                       
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group alert-msg"></div>
                                            </div> 
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
