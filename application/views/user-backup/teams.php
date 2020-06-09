<section>
    <div class="container-fluid teams">
        <div class="col-lg-4">
                <div class="panel">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                           <li class="active"><a href="#members" data-toggle="tab"><i class="fa fa-users"></i></a></li>
                           <li><a href="#new-member" data-toggle="tab"><i class="fa fa-user-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="members">
                                <ul></ul>
                                 <div class="row">
                                    <div class="col col-lg-12">
                                        <ul class="pagination"></ul>
                                    </div>
                                </div>                               
                            </div>
                            <div class="tab-pane fade" id="new-member">
                                <?= form_open('user/teams', ['class' => 'new-member']) ?>
                                    <div class="list-group">
                                        <div class="list-group-item" id="input-fields">
                                            <div class="form-group">
                                                <input class="form-control username" type="text" placeholder="<?= $this->lang->line( 'mu316' ); ?>" value="m_" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control password" type="password" placeholder="<?= $this->lang->line( 'mu317' ); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-labeled btn-primary pull-right"><?= $this->lang->line( 'mu315' ); ?></button>
                                            </div>
                                        </div>
                                    </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-8">
            <div class="col-lg-12 user-data">
                <div class="widget-box">
                    <div class="widget-header">
                        <div class="widget-toolbar">
                            <ul class="nav nav-tabs">
                                <li class="active"> <a data-toggle="tab" href="#details" aria-expanded="true"><?= $this->lang->line( 'mu50' ); ?></a> </li>
                                <li> <a data-toggle="tab" href="#settings" aria-expanded="true"><?= $this->lang->line( 'mu7' ); ?></a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="tab-content">
                            <div id="details" class="tab-pane active">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line( 'mu78' ); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right member_username">
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line( 'mu318' ); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right date_joined">
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line( 'mu319' ); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right last_access">
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div id="settings" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?= form_open('user/team', ['class' => 'update-settings']) ?>
                                            <div class="list-group">
                                                <div class="list-group-item" id="input-fields">
                                                    <div class="form-group">
                                                        <label for="basic-input"><?= $this->lang->line( 'mu78' ); ?></label>
                                                        <input class="form-control member_username" disabled="disabled">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basic-input"><?= $this->lang->line( 'mu80' ); ?></label>
                                                        <input class="form-control password" type="password" placeholder="<?= $this->lang->line( 'mu83' ); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="basic-input"><?= $this->lang->line( 'mu81' ); ?></label>
                                                        <input class="form-control rpassword" type="password" placeholder="<?= $this->lang->line( 'mu84' ); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12 clean">
                                                            <button type="submit" class="btn btn-success pull-right"><?= $this->lang->line( 'mu86' ); ?></button>
                                                        </div>
                                                    </div>                       
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
