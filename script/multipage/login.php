<?php
//include config
require_once('config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: index.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end if submit

//define page title
$title = 'Facebook Business and Emails Scraper';

//include header template
require('layout/header.php'); 
?>

	<div class="wrapper">
<div class="container" style="text-align:center">

	<div class="row">
<div class="col-sm-3">
</div>
	    <div class="col-sm-6">
<br><br>
			<form role="form" method="post" action="" autocomplete="off">
				<h3>Facebook Business and Emails Scraper Poster Login</h3>
				
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='alert alert-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='alert alert-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='alert alert-success'>Password changed, you may now login.</h2>";
							break;
					}

				}

				
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" required class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" required class="form-control input-lg" placeholder="Password" tabindex="3">
				</div>
				
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						 <a href='reset.php'>Forgot your Password?</a>
					</div>
				</div>
				
				<hr>
				<div class="row">
					<div class="col-xs-12 col-md-12"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</form>
<hr>
<a class="btn btn-default btn-block btn-lg" href="register.php">Sign up</a>
<hr>
		</div>
		
		
		
		<div class="col-sm-3">
		<!--<br><br><br><br><br>
		<h2>Login Via </h2>
		<br><br><br><br>
		<a class="btn btn-default btn-block btn-lg" href="fb" style="background-color: rgb(60, 90, 152);border: none;border-radius: 0px;"><span class="pull-left"><i class="zmdi zmdi-hc-fw"></i></span>  Login Via Facebook</a>
		-->
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>
