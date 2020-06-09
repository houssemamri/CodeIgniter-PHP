<section>
    <div class="container-fluid insights">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-lg-12">
                <div class="row">
                    <div class="panel-heading">
                        <h2><i class="fa fa-share-square-o"></i> <?= $this->lang->line('mu91'); ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 social-list">
                        <ul>
                            <li class="netsel" data-network="facebook_pages">
                                <span class="icon pull-left" style="background-color:#3b5998"><i class="fa fa-facebook"></i></span> <span class="netaccount pull-left">Facebook Pages<i><?= get_accounts_per_network( 'facebook_pages' ); ?> <?= $this->lang->line('mu140') ?></i></span>
                                <?php
                                $details = get_network_details('Facebook_pages');
                                if ( $details['accounts'] ) {
                                    ?>
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn btn-default show-accounts">
                                            <i class="fa fa-bars" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
                            </li>
                            <li class="socials" data-network="facebook_pages">
                                <div class="row">
                                    <div class="col-lg-12"><i class="fa fa-search" aria-hidden="true"></i><input class="search-accounts form-control" placeholder="Search Accounts"><button class="show-selected" type="button"><i class="fa fa-times" aria-hidden="true"></i></button></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="sell-accounts">
                                            <?php
                                            if ( @$details['accounts'] ) {

                                                foreach ($details['accounts'] as $account) {
                                                    ?>
                                                    <li>
                                                        <?= $account->user_name; ?> <span class="expires"><?= $this->lang->line('mu39'); ?> <strong><?= (trim($account->expires) == '') ? $this->lang->line('mu40') : substr($account->expires, 0, 19); ?></strong></span>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default select-net display-insights" data-account="<?= $account->network_id; ?>" data-net="<?= $account->net_id; ?>">
                                                                <?= $this->lang->line('mu347') ?>
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
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 insights-details">
            <div class="col-lg-12 mess-stat">
                <ul>
                    <li><?= $this->lang->line('mu348'); ?></li>
                </ul>
            </div>
            <div class="col-lg-12 main-insights">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#general" data-toggle="tab"><?= $this->lang->line('mu73'); ?></a></li>
                    <li><a href="#posts" data-toggle="tab"><?= $this->lang->line('mu2'); ?></a></li>
                    <li><a href="#videos" data-toggle="tab"><?= $this->lang->line('mu357'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <div id="general" class="tab-pane active">
                        <div class="col-lg-12 stat-head">
                            <div class="dropdown pull-left">
                                <button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown"><?= $this->lang->line('mu358'); ?> <span class="caret"></span></button>
                                <ul class="dropdown-menu multi-level filter-graph-type" role="menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="#" data-type="page_views_total"><?= $this->lang->line('mu359'); ?></a></li>
                                    <li><a href="#" data-type="page_impressions"><?= $this->lang->line('mu360'); ?></a></li>
                                    <li><a href="#" data-type="page_impressions_paid"><?= $this->lang->line('mu361'); ?></a></li>
                                    <li><a href="#" data-type="page_impressions_organic"><?= $this->lang->line('mu362'); ?></a></li>
                                    <li><a href="#" data-type="page_engaged_users"><?= $this->lang->line('mu363'); ?></a></li>
                                    <li><a href="#" data-type="page_fans"><?= $this->lang->line('mu364'); ?></a></li>
                                    <li><a href="#" data-type="page_fans_online"><?= $this->lang->line('mu365'); ?></a></li>
                                    <li><a href="#" data-type="page_total_actions"><?= $this->lang->line('mu366'); ?></a></li>
                                    <li><a href="#" data-type="page_stories"><?= $this->lang->line('mu367'); ?></a></li>
                                </ul>
                            </div>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default graph-select-range select-range" data-value="week"><?= $this->lang->line('mu368'); ?></button>
                                <button type="button" class="btn btn-default graph-select-range select-range active" data-value="days_28"><?= $this->lang->line('mu369'); ?></button>
                            </div>
                        </div>
                        <div class="col-lg-12 stat-head">
                            <div id="general-stats-insights" class="graph"></div>
                        </div>
                    </div>
                    <div id="posts" class="tab-pane">
                        <div class="col-lg-12 posts-section clean">
                        </div>
                    </div>
                    <div id="videos" class="tab-pane">
                        <div class="col-lg-12 videos-section clean">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>