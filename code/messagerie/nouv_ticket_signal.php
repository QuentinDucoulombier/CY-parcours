<?php
    session_start();

    function recup_message($id) {
      $json = file_get_contents("../messagerie/messages/messages.json",true);
      $message_array = json_decode($json,true);


      foreach ($message_array["log_messages"] as $key => $value) {
        if($message_array["log_messages"][$key]["id"] == $id){
          return $message_array["log_messages"][$key];
        }
      }
    }

    $id = $_POST["id"];
    $message = recup_message($id);
    $message_json = json_encode($message);
    $motif = $_POST["motif"];
    $description = $_POST["description"];

    $json = file_get_contents("../messagerie/logs/ticket_message.json",true);
    $array = json_decode($json,true);

    $array["nb_ticket"] += 1;

    $nouv_ticket_json= '{
      "message":'.$message_json.',
      "motif":"'.$motif.'",
      "description":"'.$description.'"
    }';
    $nouv_ticket = json_decode($nouv_ticket_json,true);

    array_push($array["tickets"],$nouv_ticket);

    $new_json =json_encode($array);

    file_put_contents("../messagerie/logs/ticket_message.json",$new_json,FILE_USE_INCLUDE_PATH);

    echo 1;
?>
