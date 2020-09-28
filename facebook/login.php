<?php

session_start();

require_once('php-graph-sdk-5.x/src/Facebook/autoload.php');
/*require_once('php-graph-sdk-5.x/src/Facebook/Facebook.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookApp.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookBatchRequest.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookBatchResponse.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookClient.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookRequest.php');
require_once('php-graph-sdk-5.x/src/Facebook/FacebookResponse.php');*/


$fb = new Facebook\Facebook([
  'app_id' => '2326895634303428', // Replace {app-id} with your app id
  'app_secret' => 'dba1c63eb3596caf6574eff9af4b4a35',
  'default_graph_version' => 'v2.6',
  'persistent_data_handler' => "session",
  ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email','user_photos','publish_actions']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/facebook/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';