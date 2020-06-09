<?php
session_start();
// INDEX MAIN

if(isset($_SESSION['bp_logged']) && $_SESSION['bp_logged'] === TRUE){
    
    header('Location: ./search/');
    exit();
}
else{
include_once('header.php');
?>
<div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <img src="assets/images/logo_fbseeker.png" />
                            <hr>
                            <?php
                            if(isset($_GET['login_error'])){
                                echo '<div style="margin-left: 0;box-shadow:unset;" class="alert alert-danger alert-dismissible" role="alert">
                                      <strong>Warning!</strong> Wrong login username/password!
                                    </div>';
                            }
                            
                            if(isset($_GET['error_authorize'])){
                                echo '<div style="margin-left: 0;box-shadow:unset;" class="alert alert-danger alert-dismissible" role="alert">
                                      <strong>Warning!</strong> You must authorize facebook App!
                                    </div>';
                            }
                            ?>
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="./login/" method="post" role="form" style="display: block;">

                                    <div class="form-group">
                                      <div>
                                      <input id="username" name="username" placeholder="User Name" class="form-control input-md" type="text">
                                      </div>
                                    </div>

                                    <!-- Password input-->
                                    <div class="form-group">
                                      <div>
                                        <input id="password" name="password" placeholder="Password" class="form-control input-md" type="password">
                                      </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="form-group">
                                      <div class="col-sm-6 col-sm-offset-3">
                                        <input id="login-submit" class="form-control btn btn-login" type="submit" value="Log In"  name="login-submit">
                                      </div>
                                    </div>
                                </form>
                            </div> <!-- col-lg-12 -->
                        </div> <!-- row -->
                    </div> <!-- panel-body -->

                </div> <!-- panel panel-login -->
            </div> <!-- col-md-6 col-md-offset-3 -->
        </div> <!-- row -->
    </div> <!-- container -->


<?php
}
include_once('footer.php');
?>
