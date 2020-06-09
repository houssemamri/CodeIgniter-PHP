<section>
    <div class="container-fluid settings">
        <div class="row">
            <div class="col-lg-12"> 
                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel-heading">
                            <h2><i class="fa fa-cog"></i> <?= $this->lang->line('ma7'); ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <div class="widget-toolbar">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#general" aria-expanded="true"><?= $this->lang->line('ma34'); ?></a></li>
                                            <li><a data-toggle="tab" href="#advanced" aria-expanded="false"><?= $this->lang->line('ma35'); ?></a></li>
                                            <li><a data-toggle="tab" href="#users" aria-expanded="false"><?= $this->lang->line('ma36'); ?></a></li>
                                            <li><a data-toggle="tab" href="#appearance" aria-expanded="false"><?= $this->lang->line('ma37'); ?></a></li>
                                            <li><a data-toggle="tab" href="#payments" aria-expanded="false"><?= $this->lang->line('ma38'); ?></a></li>
                                            <li><a data-toggle="tab" href="#smtp" aria-expanded="false"><?= $this->lang->line('ma39'); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div class="tab-content">
                                            <div id="general" class="tab-pane active">
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma46'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="rss_feeds" name="rss_feeds" class="setopt" <?php if (isset($options['rss_feeds'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="rss_feeds"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma136'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="email_marketing" name="email_marketing" class="setopt" <?php if (isset($options['email_marketing'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="email_marketing"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma182'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="insights" name="insights" class="setopt" <?php if (isset($options['insights'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="insights"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma151'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="disable-tickets" name="disable-tickets" class="setopt" <?php if (isset($options['disable-tickets'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="disable-tickets"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma40'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-scheduled-notifications" class="setopt" <?php if (isset($options['enable-scheduled-notifications'])) echo 'checked="checked"'; ?> name="enable-scheduled-notifications" type="checkbox">
                                                            <label for="enable-scheduled-notifications"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma41'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-scheduled" name="enable-scheduled" class="setopt" <?php if (isset($options['enable-scheduled'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-scheduled"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma139'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-emojis" name="enable-emojis" class="setopt" <?php if (isset($options['enable-emojis'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-emojis"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma42'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-image-uplodad" name="enable-image-uplodad" class="setopt" <?php if (isset($options['enable-image-uplodad'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-image-uplodad"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma138'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-video-uplodad" name="enable-video-uplodad" class="setopt" <?php if (isset($options['enable-video-uplodad'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-video-uplodad"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma43'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-draft-messages" name="enable-draft-messages" class="setopt" <?php if (isset($options['enable-draft-messages'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-draft-messages"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma44'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-notifications-email" name="enable-notifications-email" class="setopt" <?php if (isset($options['enable-notifications-email'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-notifications-email"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma45'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="report-bug" class="setopt" <?php if (isset($options['report-bug'])) echo 'checked="checked"'; ?> name="report-bug" type="checkbox">
                                                            <label for="report-bug"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->config->item('site_name') ?> <?= $this->lang->line('ma47'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="shortener" name="shortener" class="setopt" <?php if (isset($options['shortener'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="shortener"></label>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div id="advanced" class="tab-pane">
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma48'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="input-group spinner pull-right">
                                                            <input type="text" class="form-control optionvalue" id="upload_limit" value="<?php
                                                            if (isset($options['upload_limit'])): echo $options['upload_limit'];
                                                            else: echo 6;
                                                            endif;
                                                            ?>">
                                                            <div class="input-group-btn-vertical">
                                                                <button class="btn btn-default" data-id="upload_limit" type="button"><i class="fa fa-caret-up"></i></button>
                                                                <button class="btn btn-default" data-id="upload_limit" type="button"><i class="fa fa-caret-down"></i></button>
                                                            </div>
                                                        </div>
                                                        <span class="pull-right">MB</span>
                                                    </div>
                                                </div>
                                                <?php if (isset($options['tool_monitoris'])): ?>
                                                    <div class="setrow">
                                                        <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma49'); ?> </div>
                                                        <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                            <div class="input-group spinner pull-right">
                                                                <input type="text" class="form-control optionvalue" id="monitoris_limit" value="<?php
                                                                if (isset($options['monitoris_limit'])): echo $options['monitoris_limit'];
                                                                else: echo 1;
                                                                endif;
                                                                ?>">
                                                                <div class="input-group-btn-vertical">
                                                                    <button class="btn btn-default" data-id="monitoris_limit" type="button"><i class="fa fa-caret-up"></i></button>
                                                                    <button class="btn btn-default" data-id="monitoris_limit" type="button"><i class="fa fa-caret-down"></i></button>
                                                                </div>
                                                            </div>
                                                            <span class="pull-right"><?= $this->lang->line('ma50'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (isset($options['tool_posts-planner'])): ?>
                                                    <div class="setrow">
                                                        <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma143'); ?> </div>
                                                        <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                            <div class="input-group spinner pull-right">
                                                                <input type="text" class="form-control optionvalue" id="posts_planner_limit" value="<?php
                                                                if (isset($options['posts_planner_limit'])): echo $options['posts_planner_limit'];
                                                                else: echo 1;
                                                                endif;
                                                                ?>">
                                                                <div class="input-group-btn-vertical">
                                                                    <button class="btn btn-default" data-id="posts_planner_limit" type="button"><i class="fa fa-caret-up"></i></button>
                                                                    <button class="btn btn-default" data-id="posts_planner_limit" type="button"><i class="fa fa-caret-down"></i></button>
                                                                </div>
                                                            </div>
                                                            <span class="pull-right"><?= $this->lang->line('ma144'); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma150'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="input-group spinner pull-right">
                                                            <input type="text" class="form-control optionvalue" id="tickets_limit" value="<?php
                                                            if (isset($options['tickets_limit'])): echo $options['tickets_limit'];
                                                            else: echo 24;
                                                            endif;
                                                            ?>">
                                                            <div class="input-group-btn-vertical">
                                                                <button class="btn btn-default" data-id="tickets_limit" type="button"><i class="fa fa-caret-up"></i></button>
                                                                <button class="btn btn-default" data-id="tickets_limit" type="button"><i class="fa fa-caret-down"></i></button>
                                                            </div>
                                                        </div>
                                                        <span class="pull-right"><?= $this->lang->line('mm107'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma183'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="input-group spinner pull-right">
                                                            <input type="text" class="form-control optionvalue" id="rss_process_limit" value="<?php
                                                            if (isset($options['rss_process_limit'])): echo $options['rss_process_limit'];
                                                            else: echo 1;
                                                            endif;
                                                            ?>">
                                                            <div class="input-group-btn-vertical">
                                                                <button class="btn btn-default" data-id="rss_process_limit" type="button"><i class="fa fa-caret-up"></i></button>
                                                                <button class="btn btn-default" data-id="rss_process_limit" type="button"><i class="fa fa-caret-down"></i></button>
                                                            </div>
                                                        </div>
                                                        <span class="pull-right"><?= $this->lang->line('ma46'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma152'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="user_smtp" name="user_smtp" class="setopt" <?php if (isset($options['user_smtp'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="user_smtp"></label>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma166'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-old-scheduling" name="enable-old-scheduling" class="setopt" <?php if (isset($options['enable-old-scheduling'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-old-scheduling"></label>
                                                        </div>
                                                    </div>
                                                </div>                                         
                                            </div>                                     
                                            <div id="users" class="tab-pane">
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma51'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-registration" name="enable-registration" class="setopt" <?php if (isset($options['enable-registration'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-registration"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma52'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="social-signup" name="social-signup" class="setopt" <?php if (isset($options['social-signup'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="social-signup"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma53'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="enable-new-user-notification" name="enable-new-user-notification" class="setopt" <?php if (isset($options['enable-new-user-notification'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="enable-new-user-notification"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma54'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="signup_confirm" name="signup_confirm" class="setopt" <?php if (isset($options['signup_confirm'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="signup_confirm"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma55'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="signup_limit" name="signup_limit" class="setopt" <?php if (isset($options['signup_limit'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="signup_limit"></label>
                                                        </div>
                                                    </div>
                                                </div>                                     
                                            </div>                  
                                            <div id="appearance" class="tab-pane">
                                                <div class="setrow" id="login-logo">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma56'); ?></h3></div>
                                                    <p class="preview"><?php if (isset($options['login-logo'])) echo '<img src="' . $options['login-logo'] . '" class="thumbnail" />'; ?></p>
                                                    <p><a class="btn btn-default login-logo" href="#"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?= $this->lang->line('ma58'); ?></a></p>
                                                    <div class="error-upload"></div>
                                                    <hr>
                                                </div>
                                                <div class="setrow" id="main-logo">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma57'); ?></h3></div>
                                                    <p class="preview"><?php if (isset($options['main-logo'])) echo '<img src="' . $options['main-logo'] . '" class="thumbnail" />'; ?></p>
                                                    <p><a class="btn btn-default main-logo" href="#"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?= $this->lang->line('ma58'); ?></a></p>
                                                    <div class="error-upload"></div>
                                                    <hr>
                                                </div>
                                                <div class="setrow" id="favicon">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma59'); ?></h3></div>
                                                    <p class="preview"><?php if (isset($options['favicon'])) echo '<img src="' . $options['favicon'] . '" class="thumbnail" />'; ?></p>
                                                    <p><a class="btn btn-default favicon" href="#"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?= $this->lang->line('ma58'); ?></a></p>
                                                    <div class="error-upload"></div>
                                                    <hr>
                                                </div>
                                                <div class="setrow" id="login-bg">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma60'); ?></h3></div>
                                                    <p class="preview"><?php
                                                        if (isset($options['login-bg'])) {
                                                            $videoformat = ['avi', 'mp4', 'webm'];
                                                            // check if the $options['login-bg'] url is a video
                                                            $extension = pathinfo(get_option("login-bg"), PATHINFO_EXTENSION);
                                                            if (@in_array($extension, $videoformat)) {
                                                                echo '<video class="fillWidth fadeIn wow collapse in" id="video-background" width="187"><source src="' . $options['login-bg'] . '" type="video/mp4"></video>';
                                                            } else {
                                                                echo '<img src="' . $options['login-bg'] . '" class="thumbnail" />';
                                                            }
                                                        }
                                                        ?></p>
                                                    <p><a class="btn btn-default login-bg" href="#"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?= $this->lang->line('ma61'); ?></a></p>
                                                    <div class="error-upload"></div>
                                                    <hr>
                                                        <?php
                                                        // if the login page background is a video file the user can upload a cover
                                                        if (@in_array($extension, $videoformat)) {
                                                            ?>
                                                    </div>
                                                    <div class="setrow" id="cover-bg">
                                                        <div class="image-head-title"><h3><?= $this->lang->line('ma62'); ?></h3></div>
                                                        <p class="preview"><?php
                                                        if (isset($options['cover-bg'])) {
                                                            $extension = pathinfo(get_option("cover-bg"), PATHINFO_EXTENSION);
                                                            echo '<img src="' . $options['cover-bg'] . '" class="thumbnail" />';
                                                        }
                                                        ?></p>
                                                        <p><a class="btn btn-default cover-bg" href="#"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <?= $this->lang->line('ma58'); ?></a></p>
                                                        <div class="error-upload"></div>
                                                        <hr>
    <?php
}
?>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma63'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="login-bg-color" value="<?= @$options['login-bg-color'] ? $options['login-bg-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma64'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="login-text-color" value="<?= @$options['login-text-color'] ? $options['login-text-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma65'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="login-button-color" value="<?= @$options['login-button-color'] ? $options['login-button-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma66'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="main-menu-color" value="<?= @$options['main-menu-color'] ? $options['main-menu-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma67'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="main-menu-text-color" value="<?= @$options['main-menu-text-color'] ? $options['main-menu-text-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma68'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="panel-heading-color" value="<?= @$options['panel-heading-color'] ? $options['panel-heading-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="image-head-title"><h3><?= $this->lang->line('ma69'); ?></h3></div>      
                                                    <div class="enablus">
                                                        <input type="color" class="optionvalue" id="panel-heading-text-color" value="<?= @$options['panel-heading-text-color'] ? $options['panel-heading-text-color'] : '#000000'; ?>"  />
                                                    </div>
                                                </div>
                                                <!--upload media form !-->
                                                <div class="hidden">
                                                    <?php
                                                    $attributes = array('class' => 'upmedia', 'method' => 'post');
                                                    echo form_open_multipart('admin/settings', $attributes);
                                                    ?>
                                                    <input type="file" name="file" id="file">
                                                    <input type="text" name="media-name" id="media-name">
                                                    <?php
                                                    echo form_close();
                                                    ?>
                                                </div>
                                            </div>
                                            <div id="payments" class="tab-pane">
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma70'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="plans-notice" name="plans-notice" class="setopt" <?php if (isset($options['plans-notice'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="plans-notice"></label>
                                                        </div>
                                                    </div>
                                                </div>                                     
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma71'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="paypal-address" value="<?= @$options['paypal-address']; ?>" placeholder="<?= $this->lang->line('ma72'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma73'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="identity-token" value="<?= @$options['identity-token']; ?>" placeholder="<?= $this->lang->line('ma74'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>                                       
<?php
if (file_exists(FCPATH . 'vendor/stm/init.php')):
    ?>
                                                    <div class="setrow">
                                                        <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma75'); ?></div></div>
                                                        <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                            <div class="enablus pull-right">
                                                                <input type="text" class="optionvalue" id="stripe-secret" value="<?= @$options['stripe-secret']; ?>" placeholder="<?= $this->lang->line('ma76'); ?>" />
                                                            </div>
                                                        </div>                                        
                                                    </div>
    <?php
endif;
?>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma153'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="merchant-id" value="<?= @$options['merchant-id']; ?>" placeholder="<?= $this->lang->line('ma154'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma162'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="2co-account-number" value="<?= @$options['2co-account-number']; ?>" placeholder="<?= $this->lang->line('ma163'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma164'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="2co-secret-word" value="<?= @$options['2co-secret-word']; ?>" placeholder="<?= $this->lang->line('ma165'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>                                        
                                            </div>
                                            <div id="smtp" class="tab-pane">
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma77'); ?></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="smtp-enable" name="smtp-enable" class="setopt" <?php if (isset($options['smtp-enable'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="smtp-enable"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma167'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="smtp-protocol" value="<?= @$options['smtp-protocol']; ?>" placeholder="<?= $this->lang->line('ma168'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma78'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="smtp-host" value="<?= @$options['smtp-host']; ?>" placeholder="<?= $this->lang->line('ma79'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma80'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="smtp-port" value="<?= @$options['smtp-port']; ?>" placeholder="<?= $this->lang->line('ma81'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma82'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="smtp-username" value="<?= @$options['smtp-username']; ?>" placeholder="<?= $this->lang->line('ma83'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma84'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input type="text" class="optionvalue" id="smtp-password" value="<?= @$options['smtp-password']; ?>" placeholder="<?= $this->lang->line('ma85'); ?>" />
                                                        </div>
                                                    </div>                                        
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma86'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="smtp-ssl" name="smtp-ssl" class="setopt" <?php if (isset($options['smtp-ssl'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="smtp-ssl"></label>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                                <div class="setrow">
                                                    <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('ma87'); ?></div></div>
                                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                        <div class="enablus pull-right">
                                                            <input id="smtp-tls" name="smtp-tsl" class="setopt" <?php if (isset($options['smtp-tls'])) echo 'checked="checked"'; ?> type="checkbox">
                                                            <label for="smtp-tls"></label>
                                                        </div>
                                                    </div>                                      
                                                </div>
                                            </div>
                                            <div class="col-lg-12 clean alert-msg display-none"></div>
                                        </div>
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