<?php
session_start();

require_once('php-graph-sdk-5.x/src/Facebook/autoload.php');


var_dump($_SESSION['fb_access_token']);

$fb = new Facebook\Facebook([
  'app_id' => '2326895634303428', // Replace {app-id} with your app id
  'app_secret' => 'dba1c63eb3596caf6574eff9af4b4a35',
  'default_graph_version' => 'v2.6',
  'persistent_data_handler' => "session"
  ]);

$data = [
  'alt_text_custom' => 'My Photo',
  'source' => $fb->fileToUpload('./2620727-young-couple-of-lovers-woman-vacation-and-travel-nature-man-photocase-stock-photo-large.jpg'),
];

try {
  $response = $fb->POST('/108111983794249/photos', $data, $_SESSION['fb_access_token']);
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
var_dump($graphNode);

echo 'Photo ID: ' . $graphNode['id'];