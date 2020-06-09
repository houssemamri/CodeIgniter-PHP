<nav>
    <ul>
        <li<?php if ( $this->router->fetch_method() == 'dashboard' ) echo ' class="active"'; ?>> <a href="<?= site_url('user/home') ?>"><i class="fa fa-tachometer"></i><br>
                <?= $this->lang->line('mu1'); ?></a> </li>
        <li<?php if ( $this->router->fetch_method() == 'posts' ) echo ' class="active"'; ?>> <a href="<?= site_url('user/posts') ?>"><i class="fa fa-pencil-square-o"></i><br>
                <?= $this->lang->line('mu2'); ?></a> </li>
        <?php
        if ( get_option('email_marketing') && (plan_feature('sent_emails') > 0) ) {
        ?>
        <li<?php if ( $this->router->fetch_method() == 'emails' ) echo ' class="active"'; ?>><a href="<?= site_url('user/emails') ?>"><i class="fa fa-envelope"></i><br>
                <?= $this->lang->line('mu120'); ?></a></li>
        <?php
        }
        if ( get_option('rss_feeds') == 1 ) {
            ?>
            <li<?php if ( $this->router->fetch_method() == 'RSS_feeds' ) echo ' class="active"'; ?>><a href="<?= site_url('user/rss-feeds') ?>"><i class="fa fa-rss"></i><br>
                <?= $this->lang->line('mu4'); ?></a></li>
            <?php
        }
        if ( get_option('insights') == 1 ) {
            ?>
            <li<?php if ( $this->router->fetch_method() == 'insights_page' ) echo ' class="active"'; ?>><a href="<?= site_url('user/insights') ?>"><i class="fa fa-line-chart"></i><br>
                Insights</a></li>            
            <?php
        }
        if ( get_option('enable_tools_page' ) == 1) {
            ?>
            <li<?php if ( $this->router->fetch_method() == 'tools' ) echo ' class="active"'; ?>><a href="<?= site_url('user/tools') ?>"><i class="fa fa-cogs"></i><br>
                <?= $this->lang->line('mu5'); ?></a></li>
            <?php
        }
        ?>
        <?php
        if ( get_option('enable_bots_page') == 1 ) {
            ?>
            <li<?php if ($this->router->fetch_method() == 'bots') echo ' class="active"'; ?>><a href="<?= site_url('user/bots') ?>"><i class="fa fa-thumb-tack"></i><br>
                <?= $this->lang->line('mu297'); ?></a></li>
            <?php
        }
        ?> 
        <li<?php if ( $this->router->fetch_method() == 'networks' ) echo ' class="active"'; ?>> <a href="<?= site_url('user/networks') ?>"><i class="fa fa-share-square"></i><br>
            <?= $this->lang->line('mu6'); ?></a> </li>
        <?php if ( !$this->session->userdata( 'member' ) ) { ?>
        <li<?php if ( $this->router->fetch_method() == 'settings' ) echo ' class="active"'; ?>> <a href="<?= site_url('user/settings') ?>"><i class="fa fa-cog"></i><br>
            <?= $this->lang->line('mu7'); ?></a> </li>
        <?php } ?>
    </ul>
</nav>