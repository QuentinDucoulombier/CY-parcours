<?php
  $id = $_POST["id"];

  $json = file_get_contents("../messagerie/messages/messages.json",true);
  $message_array = json_decode($json,true);


  foreach ($message_array["log_messages"] as $key => $value) {
    if($message_array["log_messages"][$key]["id"] == $id){
      $message_array["log_messages"][$key]["supprime"] = true;
      break;
    }
  }


  $new_json =json_encode($message_array);

  file_put_contents("../messagerie/messages/messages.json",$new_json,FILE_USE_INCLUDE_PATH);

  echo 1;

 ?>
