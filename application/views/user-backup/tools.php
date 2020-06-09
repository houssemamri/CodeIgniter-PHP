<section>
    <div class="container-fluid tools">
        <div class="col-lg-12">
            <div class="row">
                <div class="panel-heading">
                    <h2><i class="fa fa-cogs"></i> <?= $this->lang->line('mu5'); ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-box">
                        <div class="widget-header">
                            <div class="widget-toolbar">
                                <ul class="nav">
                                    <li class="active  nav-item"  style="background-color: none !important;"> <a data-toggle="tab" href="#all" aria-expanded="true"><?= $this->lang->line('mu102'); ?></a> </li>
                                    <li class=" nav-item"  style="background-color: none !important;"> <a data-toggle="tab" href="#favorites" aria-expanded="false"><?= $this->lang->line('mu103'); ?></a> </li>
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
                                                if ($tools) {
                                                    $i = 0;
                                                    foreach ($tools as $tool) {
                                                        if (!isset($options['tool_' . $tool->slug])) continue;
                                                        ?>
                                                        <li>
                                                            <?= $tool->logo; ?>
                                                            <?php
                                                            if (property_exists($tool, 'name')) {
                                                                ?>
                                                                <span class="netaccount"><?= $tool->name; ?></span>
                                                                <?php
                                                            }
                                                            ?>
                                                            <div class="btn-group pull-right">
                                                                <a type="button" onclick="get_content_menu('<?= site_url('user/tools/' . $tool->slug) ?>','tools_div')" href="javascript:void(0)" data-type="main" class="btn btn-default">
                                                                    <?= $this->lang->line('mu105'); ?>                                                           </a>
                                                                <a type="button" href="<?= $tool->slug ?>" class="btn btn-default save-bookmark<?php
                                                                if (@in_array($tool->slug, $favourites)): echo ' saved';endif;
                                                                ?>">
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
                                                if ($tools) {
                                                    $i = 0;
                                                    foreach ($tools as $tool) {
                                                        if (!@in_array($tool->slug, $favourites)): continue;
                                                        endif;
                                                        $i++;
                                                        ?>
                                                        <li>
                                                            <?= $tool->logo; ?>
                                                            <?php
                                                            if (property_exists($tool, 'name')) {
                                                                ?>
                                                                <span class="netaccount"><?= $tool->name; ?></span>
                                                                <?php
                                                            }
                                                            ?>
                                                            <div class="btn-group pull-right">
                                                                <a type="button" href="<?= site_url('user/tools/' . $tool->slug) ?>" data-type="main" class="btn btn-default">
                                                                    <?= $this->lang->line('mu105'); ?>
                                                                </a>
                                                                <a type="button" href="<?= $tool->slug ?>" class="btn btn-default save-bookmark<?php
                                                                if (@in_array($tool->slug, $favourites)): echo ' saved';
                                                                endif;
                                                                ?>">
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
