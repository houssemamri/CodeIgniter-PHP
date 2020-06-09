<section>
    <div class="container-fluid networks">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel-heading">
                            <h2><i class="fa fa-check-square-o" aria-hidden="true"></i> <?= ucwords(str_replace('_', ' ', $network)) ?></h2>
                        </div>
                    </div>          
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="setrow">
                                <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma124'); ?></div>
                                <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                    <div class="enablus pull-right">
                                        <input id="<?= $network ?>" name="<?= $network ?>" class="setopt"<?php if (get_option($network)) echo ' checked="checked"' ?> type="checkbox">
                                        <label for="<?= $network ?>"></label>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $detail = get_network_details(ucfirst($network));
                            if ($detail['network']) {
                                foreach ($detail['network']->api as $api) {
                                    ?>
                                    <div class="setrow">
                                        <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= ucwords(str_replace('_', ' ', $api)) ?></div></div>
                                        <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                            <div class="enablus pull-right">
                                                <?php if ($api == 'proxy'): ?>
                                                    <textarea class="optionvalue" id="<?= $network . '_' . $api ?>" placeholder="Enter one IP per line(example: http://00.00.00.00:(port) or with ssl)"><?= @$options[$network . '_' . $api]; ?></textarea>
                                                <?php else: ?>
                                                    <input type="text" class="optionvalue" id="<?= $network . '_' . $api ?>" value="<?= @$options[$network . '_' . $api]; ?>" placeholder="<?= ucwords(str_replace('_', ' ', $api)) ?>">
                                                <?php endif; ?>	
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if(($network == 'facebook_groups') || ($network == 'facebook_pages') || ($network == 'facebook')) {
                                ?>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma145'); ?></div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="<?= $network ?>_via_permission" name="<?= $network ?>_via_permission" class="setopt"<?php if (get_option($network.'_via_permission')) echo ' checked="checked"' ?> type="checkbox">
                                            <label for="<?= $network ?>_via_permission"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma146'); ?></div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="<?= $network ?>_user_api_key" name="<?= $network ?>_user_api_key" class="setopt"<?php if (get_option($network.'_user_api_key')) echo ' checked="checked"' ?> type="checkbox">
                                            <label for="<?= $network ?>_user_api_key"></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else if($network == 'google_plus') {
                                ?>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9">I'm Google Partner</div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="<?= $network ?>_google_partener" name="<?= $network ?>_google_partener" class="setopt"<?php if (get_option($network.'_google_partener')) echo ' checked="checked"' ?> type="checkbox">
                                            <label for="<?= $network ?>_google_partener"></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else if($network == 'pinterest') {
                                ?>
                                <div class="setrow">
                                    <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('ma146'); ?></div>
                                    <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                        <div class="enablus pull-right">
                                            <input id="<?= $network ?>_user_api_key" name="<?= $network ?>_user_api_key" class="setopt"<?php if (get_option($network.'_user_api_key')) echo ' checked="checked"' ?> type="checkbox">
                                            <label for="<?= $network ?>_user_api_key"></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    $info = $class->get_info();
                    if ( @$info->extra ) {
                        echo $info->extra;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
