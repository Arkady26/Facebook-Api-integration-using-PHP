<?php
session_start();
require_once 'src/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '194351271490242',
  'app_secret' => 'ad18a430248351076226f4c2384245e5',
  'default_graph_version' => 'v3.3',
  "persistent_data_handler"=>"session"
  ]);

$data = [
  // 'link' => 'My Foo Video',
  'message' => 'This image is full of foo and bar action.',
  'source' => $fb->fileToUpload('12.jpg'),
];

try {
  $response = $fb->post('/me/photos', $data,$_SESSION['facebook_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();


echo 'PHOTO ID: ' . $graphNode['id'];
?>