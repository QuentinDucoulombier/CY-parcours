<?php
    session_start();


    function verification_auteur_destinataire($auteur_message , $destinataire_message){
        $user = json_decode($_SESSION["user"],true);
        $autre = json_decode($_SESSION["autre"],true);

        if($auteur_message == $user && $destinataire_message == $autre){
            return "envoye";
        }elseif($auteur_message == $autre &&  $destinataire_message == $user){
            return "recu";
        }else{
            return "false";
        }
    }


    $json = file_get_contents("../messagerie/messages/messages.json",true);
    $message_array = json_decode($json,true)["log_messages"];

    $res_array = [];

    foreach($message_array as $message){
        $responce = verification_auteur_destinataire($message["auteur"],$message["destinataire"]);
        if($responce != "false"){
            array_push($res_array, array("statut" => $responce ,"message" => $message));
        }
    }

    $res_json = json_encode($res_array);

    echo $res_json;
?>
