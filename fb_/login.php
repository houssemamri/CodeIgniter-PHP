<?php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed
$fb = new Facebook\Facebook([
  'app_id' => '422613808189780',
  'app_secret' => '95833c8560de19c30da6a653957e1c2c',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','manage_pages', 'pages_show_list', 'public_profile']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/fb_/fb-callback.php', $permissions);
 
 
?> 
 APP ID : <input type="text" name="app_id"><br>
  APP SECRET KEY: <input type="text" name="app_secret"><br>
  
  <?php
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';