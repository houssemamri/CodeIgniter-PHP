
<body>
        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="https://review-thunder.com"><img src="<?php echo base_url();?>assets/admin/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="https://review-thunder.com"><img src="<?php echo base_url();?>assets/admin/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="https://review-thunder.com/blog/admin/?id=1"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Posts</h3><!-- /.menu-title -->
                    <li><a href="<?php echo base_url();?>admin/AddPost"> <i class="menu-icon fa fa-file-text"></i>Add Posts </a></li>
                    <li><a href="<?php echo base_url();?>admin/ManagePost"> <i class="menu-icon fa fa-file-text"></i>Manage Posts </a></li>
                    <h3 class="menu-title">Mini Blog Posts</h3><!-- /.menu-title -->
                    <li><a href="<?php echo base_url();?>admin/mini/AddPost"> <i class="menu-icon fa fa-file-text"></i>Add Posts </a></li>
                    <li><a href="<?php echo base_url();?>admin/mini/ManagePost"> <i class="menu-icon fa fa-file-text"></i>Manage Posts </a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
