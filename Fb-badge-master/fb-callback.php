<?php
session_start();
require_once 'src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '2579321662087280',
  'app_secret' => 'f806d2168553eb7a571bb3b1fa225b03',
  'default_graph_version' => 'v3.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
 $_SESSION['fb_access_token'] = (string) $accessToken;
 $postURL = "http://localhost/connect_db/post-photo.php";
 echo '<a href="' .$postURL. '"> post image on facebook!</a>';
  $response = $fb->get('/me?fields=email',$_SESSION['facebook_access_token'] );
  $userNode = $response->getGraphUser();
  echo "<pre>";
  print_r($userNode);

}


?>