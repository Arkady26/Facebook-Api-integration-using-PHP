<?php
if (!empty($_FILES)) {
   $uploaddir = './'; // Upload folder
   $uploadfile = $uploaddir . basename($_FILES['source']['name']);
   if (move_uploaded_file($_FILES['source']['tmp_name'], $uploadfile)) {
       $attachment =  array(
           'message'  => "hi",
           'source' => "@" . realpath($uploadfile),
           'no_story' => true
       );
       $api_response = new FacebookRequest($session,'POST','/',$attachment);
       $result = json_decode($api_response, TRUE);
       $id = $result->id;

   }    
}
?>