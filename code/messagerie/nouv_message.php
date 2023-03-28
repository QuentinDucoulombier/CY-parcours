<?php
    session_start();
    $auteur = $_SESSION["user"];
    $destinataire = $_SESSION["autre"];

    $message = $_POST["message"];

    $json = file_get_contents("../messagerie/messages/messages.json",true);
    $message_array = json_decode($json,true);

    $new_id = $message_array["id_dernier_message"] +1;
    $message_array["id_dernier_message"] +=1;

    $date = date("d/m/Y");
    $heure = date("H:i:s");

    $nouv_message_json= '{
        "id": '.$new_id.',
        "infos" :
        {
            "date" : "'.$date.'",
            "heure" : "'.$heure.'"
        },
        "auteur":
        '.$auteur.',
        "destinataire":
        '.$destinataire.',
        "message":"'.$message.'",
        "supprime":false
    }';
    $nouv_message = json_decode($nouv_message_json,true);

    array_push($message_array["log_messages"],$nouv_message);

    $new_json =json_encode($message_array);

    file_put_contents("../messagerie/messages/messages.json",$new_json,FILE_USE_INCLUDE_PATH);

    echo $nouv_message_json;
?>
