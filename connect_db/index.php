<?php
session_start();
require_once 'src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '194351271490242', 
  'app_secret' => 'ad18a430248351076226f4c2384245e5',
  'default_graph_version' => 'v3.3',
   "persistent_data_handler"=>"session"
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','user_links','publish_actions']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/connect_db/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>