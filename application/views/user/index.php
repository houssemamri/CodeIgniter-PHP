<section>
    <div class="container-fluid dashboard">
        <div class="row">
            <?php get_widgets($get_plan,$this->lang,$expires_soon); ?>
        </div>
        <div class="row">
            <?php if($expired): ?>
                <div class="show-upgrade-purpose"><?= display_mess(98); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
            <?php elseif($expires_soon): ?>
                <div class="show-upgrade-purpose"><?= display_mess(99); ?> <a href="<?php echo site_url('user/plans') ?>" class="btn btn-xs btn-primary pull-right"><?= $this->lang->line('mu16'); ?></a></div>
            <?php endif; ?>
        </div>        
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel-heading">
                            <h2><i class="fa fa-share-square"></i> <?= $this->lang->line('mu17'); ?><span><?= $count ?> <?= $this->lang->line('mu18'); ?></span></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 pull-right text-right order-by">
                            <ul>
                                <li><a href="#" data-time="7" class="active"><?= $this->lang->line('mu12'); ?></a></li>
                                <li><a href="#" data-time="30"><?= $this->lang->line('mu13'); ?></a></li>
                                <li><a href="#" data-time="90"><?= $this->lang->line('mu14'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div id="statistics" class="graph"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="<?php if($sent_emails && get_option('email_marketing')): ?>col-lg-6<?php else: ?>col-lg-12<?php endif; ?>">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="panel-heading">
                            <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> <?= $this->lang->line('mu15'); ?></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mess-stat">
                            <ul>
                                <?php
                                if ($last_posts) {
                                    foreach ($last_posts as $last) {
                                        $msg = "";
                                        if (strlen($last->body) > 50) {
                                            $msg = mb_substr(strip_tags($last->body), 0, 49) . "...";
                                        } else {
                                            $msg = strip_tags($last->body);
                                        }
                                        if ($last->status == 1)
                                            $status = '<span class="label label-success">'.$this->lang->line('mu19').'</span>';
                                        elseif ($last->status == 2 && $timestamp < $last->sent_time)
                                            $status = '<span class="label label-warning">'.$this->lang->line('mu20').'</span>';
                                        elseif ($last->status == 2 && $timestamp > $last->sent_time)
                                            $status = '<span class="label label-danger">'.$this->lang->line('mu21').'</span>';
                                        else
                                            $status = '<span class="label label-default">'.$this->lang->line('mu22').'</span>';
                                        echo '<li><a href="' . site_url('user/history') . '#' . $last->post_id . '">' . $msg . '</a> ' . $status . ' <span class="pull-right">' . calculate_time($last->sent_time, time()) . '</span></li>';
                                    }
                                }
                                else {
                                    echo '<li>'.$this->lang->line('mu23').'</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if($sent_emails && get_option('email_marketing')){
                ?>
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="panel-heading">
                                <h2><i class="fa fa-bullhorn" aria-hidden="true"></i> <?= $this->lang->line('mu121'); ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 dash-campaigns">
                                <div class="list-group">
                                    <?php
                                    if($campaigns)
                                    {
                                        foreach($campaigns as $campaign) {
                                        ?>
                                            <a href="<?= site_url('user/emails/campaign/'.$campaign->campaign_id); ?>" class="list-group-item"><span class="name" style="min-width: 120px;display: inline-block;"><?= $campaign->name; ?></span> <span class="text-muted" style="font-size: 11px;"><?= $campaign->description; ?></span> <span class="badge"> <?= calculate_time($campaign->created, time()) ?></span></a>
                                        <?php
                                        }
                                    } else {
                                        echo '<p class="list-group-item">'.$this->lang->line('mm179').'</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>