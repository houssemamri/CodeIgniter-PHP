<nav>
    <ul>
        <li<?php if ($this->router->fetch_method() == 'dashboard') echo ' class="active"'; ?>> <a href="<?= site_url('admin/home') ?>"><i class="fa fa-tachometer"></i><br>
                <?= $this->lang->line('ma1'); ?></a> </li>          
        <li<?php if (($this->router->fetch_method() == 'notifications')) echo ' class="active"'; ?>> <a href="<?= site_url('admin/notifications') ?>"><i class="fa fa-bell-o"></i><br>
                <?= $this->lang->line('ma2'); ?></a> </li>
        <li<?php if (($this->router->fetch_method() == 'users') || ($this->router->fetch_method() == 'new_user')) echo ' class="active"'; ?>> <a href="<?= site_url('admin/users') ?>"><i class="fa fa-users"></i><br>
                <?= $this->lang->line('ma3'); ?></a></li>
        <li<?php if ($this->router->fetch_method() == 'tools') echo ' class="active"'; ?>><a href="<?= site_url('admin/tools') ?>"><i class="fa fa-cogs"></i><br>
                <?= $this->lang->line('ma4'); ?></a></li>
        <li<?php if ($this->router->fetch_method() == 'manage_bots') echo ' class="active"'; ?>><a href="<?= site_url('admin/bots') ?>"><i class="fa fa-thumb-tack"></i><br>
                <?= $this->lang->line('ma159'); ?></a></li>        
        <li<?php if (($this->router->fetch_method() == 'networks')) echo ' class="active"'; ?>> <a href="<?= site_url('admin/networks') ?>"><i class="fa fa-share-square"></i><br>
                <?= $this->lang->line('ma5'); ?></a> </li>
        <li<?php if (($this->router->fetch_method() == 'plans')) echo ' class="active"'; ?>> <a href="<?= site_url('admin/plans') ?>"><i class="fa fa-clone"></i><br>
                <?= $this->lang->line('ma6'); ?></a> </li>                
        <li<?php if (($this->router->fetch_method() == 'settings')) echo ' class="active"'; ?>> <a href="<?= site_url('admin/settings') ?>"><i class="fa fa-cog"></i><br>
                <?= $this->lang->line('ma7'); ?></a> </li>
    </ul>
</nav>