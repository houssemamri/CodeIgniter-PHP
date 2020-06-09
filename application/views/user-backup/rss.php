<section data-cont="<?= $selected_accounts ?>">
    <div class="container-fluid settings rss-page" data-rss="<?= $rss_id ?>">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-rss"></i> <?= $title ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <div class="widget-toolbar">
                                <ul class="nav nav-tabs">
                                    <li class="active"> <a data-toggle="tab" href="#content" aria-expanded="true"><?= $this->lang->line('mu56'); ?></a> </li>
                                    <li class=""> <a data-toggle="tab" href="#published" aria-expanded="false"><?= $this->lang->line('mu57'); ?></a> </li>
                                    <li class=""> <a data-toggle="tab" href="#networks" aria-expanded="false"><?= $this->lang->line('mu6'); ?></a> </li>
                                    <li class=""> <a data-toggle="tab" href="#settings" aria-expanded="false"><?= $this->lang->line('mu7'); ?></a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="tab-content">
                                    <div id="content" class="tab-pane active">
                                        <ul class="feed-rss">
                                            <?php
                                            if ($data) {
                                                for ($i = 0; $i < count($data['title']); $i++) {
                                                    $url = '';
                                                    $uri = '';
                                                    if ($data['url'][$i]) {
                                                        $uri = $data['url'][$i];
                                                        $url = '<p><a href="' . $data['url'][$i] . '" target="_blank">' . $data['url'][$i] . '</a></p>';
                                                    }
                                                    if (preg_match('/amazon./i', $uri)) {
                                                        $uri = explode('ref=', $uri);
                                                        $uri = $uri[0];
                                                    }
                                                    if (preg_match('/news.google/i', $uri)) {
                                                        $uri = explode('&url=', $uri);
                                                        $uri = $uri [1];
                                                    }
                                                    $sched = '';
                                                    if ($publish_way == 1) {
                                                        if (!if_scheduled($rss_id, $uri)) {
                                                            $sched = '<i class="fa fa-clock-o date-show" aria-hidden="true"></i> <input type="text" placeholder="0000-00-00 00:00" class="datetime"> <button class="rss-schedule"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></button>';
                                                        }
                                                    }
                                                    $imi = '';
                                                    if (@$data['show'][$i]) {
                                                        $imi = '<p><img src="'.$data['show'][$i].'"></p>';
                                                    }
                                                    echo '<li><div>
                                                                 <h3>' . $data["title"][$i] . ' ' . $sched . '</h3>
                                                                 <p>' . @$data["description"][$i] . '</p>
                                                                 ' . $url . '
                                                                 ' . $imi . '
                                                                 <div class="alert alert-success alert-dismissable">'.$this->lang->line('mu58').' <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a></div>
                                                                 <div class="alert alert-danger alert-dismissable">'.$this->lang->line('mu59').' <a href="#" class="close" data-dismiss="alert" aria-label="close"><i class="fa fa-times"></i></a></div>
                                                                </div>
                                                         </li>';
                                                }
                                            } else {
                                                echo '<p>'.$this->lang->line('mu60').'</p>';
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div id="published" class="tab-pane">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="last-published">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="pagination">
                                                </ul>
                                                <img src="<?= base_url('assets/img/pageload.gif'); ?>" class="pull-right pageload">
                                            </div>
                                        </div>
                                        <?php if ($published >= $limit): ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="show-upgrade-purpose"><?= display_mess(97); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
                                                </div>
                                            </div>
                                        <?php endif; ?> 
                                    </div>
                                    <div id="networks" class="tab-pane">
                                        <div class="col-lg-12 social">
                                            <?php
                                            $netrss = json_decode($rss_networks);
                                            if ($networks) {
                                                echo '<ul class="sell-accounts">';
                                                foreach ($networks as $net) {
                                                    if (check_plan_networks(strtolower($net["network_name"])) == FALSE) {
                                                        continue;
                                                    }
                                                    if (($net["expires"] == "0") || ($net["expires"] == "") || ($net["expires"] > strtotime(date('Y-m-d h:i:s')))) {
                                                        $details = get_network_details(ucfirst($net["network_name"]));
                                                        if (!@$details["network"]->rss)
                                                            continue;
                                                        ?>
                                                        <li class="netsel" data-network="<?= $net["network_name"]; ?>">
                                                            <span class="icon" style="background-color:<?= $details["network"]->color ?>"><?= $details["network"]->icon ?></span> <span class="netaccount"><?= ucwords(str_replace("_", " ", $net["network_name"])); ?></span>
                                                            <div class="btn-group pull-right">
                                                                <button type="button" data-type="main" class="btn btn-default select-net<?php if (@array_key_exists($net["network_name"], $netrss)) echo ' active'; ?>">
                                                                    <?= $this->lang->line('mu42'); ?><?php if (@array_key_exists($net["network_name"], $netrss)) echo 'ed'; ?>
                                                                </button>
                                                                <button type="button" class="btn btn-default show-accounts">
                                                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                                                </button>
                                                            </div>
                                                        </li>
                                                        <li class="socials" data-network="<?= $net["network_name"]; ?>">
                                                            <div class="row">
                                                                <div class="col-lg-12"><i class="fa fa-search" aria-hidden="true"></i><input class="search-accounts form-control" placeholder="<?= $this->lang->line('mu38'); ?>" /><button class="show-selected" type="button"><i class="fa fa-times" aria-hidden="true"></i></button></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <ul>
                                                                        <?php
                                                                        if (daccounts($netrss, $net["network_name"])) {
                                                                            echo daccounts($netrss, $net["network_name"]);
                                                                        } else if (count($details["accounts"]) > 0) {
                                                                            foreach ($details["accounts"] as $account) {
                                                                                ?>
                                                                                <li>
                                                                                    <?= $account->user_name; ?> <span class="expires"><?= $this->lang->line('mu39'); ?> <strong><?= (trim($account->expires) == "") ? 'never' : substr($account->expires, 0, 19); ?></strong></span>
                                                                                    <div class="btn-group pull-right">
                                                                                        <button type="button" class="btn btn-default select-net<?php if (@$netrss->$net["network_name"] == $account->network_id) echo ' active'; ?>" data-account="<?= $account->network_id; ?>">
                                                                                            <?= $this->lang->line('mu42'); ?><?php if (@$netrss->$net["network_name"] == $account->network_id) echo 'ed'; ?>
                                                                                        </button>
                                                                                    </div>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                echo '</ul>';
                                            }
                                            else {
                                                echo '<ul><p>'.$this->lang->line('mu61').'</p></ul>';
                                            }
                                            ?>  
                                            <input name='networks' value='<?= $rss_networks ?>' type='hidden' />            
                                        </div>
                                    </div>
                                    <div id="settings" class="tab-pane">
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu62'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="enabled" name="enabled"<?php if ($enabled == 1) echo ' checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="enabled"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu63'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="publish_description" name="publish_description"<?php if ($publish_description == 1) echo ' checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="publish_description"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu64'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="pub" name="pub"<?php if ($publish_way == 1) echo ' checked="checked"'; ?> class="setopt" type="checkbox">
                                                    <label for="pub"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu65'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="only-new-rss" name="only-new-rss" class="setopt" type="checkbox">
                                                    <label for="only-new-rss"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><?= $this->lang->line('mu294'); ?></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input id="type" name="type" class="setopt" type="checkbox"<?php if ($type == 1) echo ' checked="checked"'; ?>>
                                                    <label for="type"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('mu66'); ?></div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="optionvalue rss-settings-input" id="refferal" value="<?= $refferal ?>" placeholder="ref=abc">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('mu292'); ?></div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="optionvalue rss-settings-input" id="pboften" value="<?= $period ?>" placeholder="<?= $this->lang->line('mu293'); ?>">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('mu311'); ?></div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="optionvalue rss-settings-input" id="pinclude" value="<?= $include ?>" placeholder="<?= $this->lang->line('mu313'); ?>">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-10 col-sm-9 col-xs-9"><div class="image-head-title"><?= $this->lang->line('mu312'); ?></div></div>
                                            <div class="col-lg-2 col-sm-3 col-xs-3 text-right">
                                                <div class="enablus pull-right">
                                                    <input type="text" class="optionvalue rss-settings-input" id="pexclude" value="<?= $exclude ?>" placeholder="<?= $this->lang->line('mu313'); ?>">
                                                </div>
                                            </div>                                        
                                        </div>
                                        <div class="setrow">
                                            <div class="col-lg-12 col-sm-12 col-xs-12 clean">
                                                <button type="button" class="btn btn-danger pull-left delete-rss"><?= $this->lang->line('mu67'); ?></button>
                                                <p class="pull-left confirm"><?= $this->lang->line('mu68'); ?> <a href="#" class="delete-feeds yes"><?= $this->lang->line('mu69'); ?></a><a href="#" class="no"><?= $this->lang->line('mu70'); ?></a></p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="form-group alert-msg"></div>
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
