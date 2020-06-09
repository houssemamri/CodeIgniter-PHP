<?php
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';


session_start();
$fb = new Facebook\Facebook([
    'app_id' => '1076434519175273', // Replace {app-id} with your app id
    'app_secret' => 'de9101ea7844abe2e6e42059c583539e',
    'default_graph_version' => 'v5.0',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['manage_pages','publish_pages']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://review-thunder.com/fb/fb-callback.php', $permissions);

$facebook_link = htmlspecialchars($loginUrl);