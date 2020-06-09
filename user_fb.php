<?php
session_start();

include('connection.php');
include_once "common_function.php";

ini_set('display_errors', 1);
$user_id=$_SESSION['user_id'];
echo $user_id;


require_once ('fb_/vendor/autoload.php');

$sql="SELECT * FROM fb_setting WHERE user_id=".$user_id;
echo $sql;
	$result = $conn->query($sql);
   $row=$result->fetch_array();
/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/

$app_id = $row['fb_app_id'];
$app_secret = $row['fb_app_secret'];	 

 $fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.10',
  ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','manage_pages', 'pages_show_list', 'public_profile']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://review-thunder.com/fb_/fb-callback.php', $permissions);





/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
  


/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/
	

?>
<div class="row">
 <h6 style="font-weight:bold;"><?php echo $profile_facebook_retrieving_id_token;?>:</h6>
      
  <br /><br />
  <?php
if (isset($loginUrl)) { 
	echo "<a class='btn btn-lg btn-primary' style='display:table;margin:0 auto;'  href='" . $loginUrl . "'>$profile_facebook_connect_me!</a>";

}else{ ?>
  <br /><br />
	<a class="btn btn-lg btn-primary" onclick="logout_google();"  style="display:table;margin:0 auto;"   href='javascript:void(0);'>Logout</a>

<?php }  ?>
  </div> 


