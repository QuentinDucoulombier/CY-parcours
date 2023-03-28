<?php
$resultat = $_POST["resultat"];

file_put_contents("../../data/resultat".$_POST["filiere"].".json", $resultat);
?>