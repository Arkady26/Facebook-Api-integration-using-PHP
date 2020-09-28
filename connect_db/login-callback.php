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
 $_SESSION['facebook_access_token'] = (string) $accessToken;
 $postURL = "http://localhost/connect_db/post_photo.php";
 echo '<a href="' .$postURL. '"> post image on facebook!</a>';

  $response = $fb->get('/me?fields=id,name',$_SESSION['facebook_access_token'] );
  $userNode = $response->getGraphUser();
  echo "<pre>";
  print_r($userNode);

}


?>