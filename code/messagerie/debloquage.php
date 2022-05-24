<?php
    session_start();

    function verification_bloquage($bloqueur , $bloque){
        $user = json_decode($_SESSION["user"],true);
        $autre = json_decode($_SESSION["autre"],true);

        if($bloqueur == $user && $bloque == $autre){
            return 1;
        }else{
            return 0;
        }
    }


    $json = file_get_contents("../messagerie/logs/bloquage.json",true);
    $bloquage_array = json_decode($json,true);

    $res_array = [];

    foreach($bloquage_array as $objet){
        $bloqueur = $objet["bloqueur"];
        $bloque = $objet["bloque"];

        if(verification_bloquage($bloqueur,$bloque) == 0){
            array_push($res_array,$objet);
        }
    }

    $res_json = json_encode($res_array);

    file_put_contents("../messagerie/logs/bloquage.json",$res_json,FILE_USE_INCLUDE_PATH);

?>
