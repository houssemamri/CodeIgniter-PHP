<section>
    <div class="container-fluid tools">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-thumb-tack"></i> <?= $this->lang->line('mu297'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <div class="widget-toolbar">
                                <ul class="nav nav-tabs">
                                    <li class="active"> <a data-toggle="tab" href="#all" aria-expanded="true"><?= $this->lang->line('mu102'); ?></a> </li>
                                    <li class=""> <a data-toggle="tab" href="#favorites" aria-expanded="false"><?= $this->lang->line('mu103'); ?></a> </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="tab-content">
                                    <div id="all" class="tab-pane active">
                                        <div class="col-lg-12">
                                            <ul>
                                                <?php
                                                if ($bots) {
                                                    $i = 0;
                                                    foreach ($bots as $bot) {
                                                        if (!isset($options['bot_' . $bot[1]])) continue;
                                                        ?>
                                                        <li>
                                                            <button class="btn-tool-icon btn bots-button btn-default btn-xs pull-left" type="button"><i class="fa fa-thumb-tack"></i></button>
                                                            <span class="netaccount"><?= $bot[0]; ?></span>
                                                            <div class="btn-group pull-right">
                                                                <a type="button" href="<?= site_url('user/bots/' . $bot[1]) ?>" data-type="main" class="btn btn-default">
                                                                    <?= $this->lang->line('mu105'); ?>
                                                                </a>
                                                                <a type="button" href="<?= $bot[1] ?>" class="btn btn-default save-bookmark<?php if (@in_array($bot[1], $favourites)): echo ' saved';endif; ?>">
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <?php
                                                        $i++;
                                                    }
                                                    if ($i == 0) {
                                                        echo '<li>'.$this->lang->line('mu104').'</li>';
                                                    }
                                                } else {
                                                    echo '<li>'.$this->lang->line('mu104').'</li>';
                                                }
                                                ?>                                                
                                            </ul>          
                                        </div>
                                    </div>
                                    <div id="favorites" class="tab-pane">
                                        <div class="col-lg-12">
                                            <ul>
                                                <?php
                                                if ($bots) {
                                                    $i = 0;
                                                    foreach ($bots as $bot) {
                                                        if (!@in_array($bot[1], $favourites)): continue;
                                                        endif;
                                                        $i++;
                                                        ?>
                                                        <li>
                                                            <button class="btn-tool-icon btn bots-button btn-default btn-xs pull-left" type="button"><i class="fa fa-thumb-tack"></i></button>
                                                            <span class="netaccount"><?= $bot[0]; ?></span>
                                                            <div class="btn-group pull-right">
                                                                <a type="button" href="<?= site_url('user/bots/' . $bot[1]) ?>" data-type="main" class="btn btn-default">
                                                                    <?= $this->lang->line('mu105'); ?>
                                                                </a>
                                                                <a type="button" href="<?= $bot[1] ?>" class="btn btn-default save-bookmark<?php if (@in_array($bot[1], $favourites)): echo ' saved';endif; ?>">
                                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <?php
                                                    }
                                                    if ($i == 0) {
                                                        echo '<li>'.$this->lang->line('mu104').'</li>';
                                                    }
                                                } else {
                                                    echo '<li>'.$this->lang->line('mu104').'</li>';
                                                }
                                                ?>                                                
                                            </ul>          
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
