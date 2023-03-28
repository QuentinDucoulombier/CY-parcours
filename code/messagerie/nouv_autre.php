<?php
session_start();

$_SESSION["autre"] = '{
    "nom":"'.$_POST["nom"].'",
    "prenom":"'.$_POST["prenom"].'",
    "adresse_mail":"'.$_POST["mail"].'",
    "statut":"'.$_POST["statut"].'"
}';

$is_blocked = 0;

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


foreach($bloquage_array as $objet){
    $is_blocked = verification_bloquage($objet["bloqueur"],$objet["bloque"]);
    if($is_blocked == 1){
        break;
    }
}

echo $is_blocked;
?>
