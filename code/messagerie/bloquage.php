<?php
    session_start();

    $auteur = $_SESSION["user"];
    $destinataire = $_SESSION["autre"];

    $json = file_get_contents("../messagerie/logs/bloquage.json",true);
    $bloquage_array = json_decode($json,true);

    $nouv_bloquage_json= '{
        "bloqueur":
        '.$auteur.',
        "bloque":
        '.$destinataire.'
    }';
    $nouv_bloquage = json_decode($nouv_bloquage_json,true);

    array_push($bloquage_array,$nouv_bloquage);

    $new_json =json_encode($bloquage_array);

    file_put_contents("../messagerie/logs/bloquage.json",$new_json,FILE_USE_INCLUDE_PATH);

?>
