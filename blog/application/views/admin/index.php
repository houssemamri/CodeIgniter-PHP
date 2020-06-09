<?php
//session_start();
if(!isset($_SESSION['admin_status'])){
  header('Location: https://review-thunder.com/auth/index');
}
//include_once "common_function.php";
?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">


        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                <?php if(isset($_SESSION['user_id'])){?>
                    <div class="page-title">
                        <h1><a href="https://review-thunder.com/logout.php">Logout</a></h1>
                    </div>
                    <?php }else{ ?>
                    <div class="page-title">
                        <h1><a href="https://review-thunder.com/auth/index.php">Login</a></h1>
                    </div>
                    <?php } ;?>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            Coming Soon
        </div> <!-- .content -->
    </div><!-- /#right-panel -->
