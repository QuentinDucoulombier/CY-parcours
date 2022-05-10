<?php
$handle = fopen("../data/choixEtudiantsParcours3.csv", "r");

$raw=0;
$vide = "[]";
file_put_contents("temp.json", $vide);
  while (($data = fgetcsv($handle, 1000, ";"))) {
    if ($raw > 0) {

        for ($i=0; $i < 11; $i++) {
          //echo "<td>".$data[$i]."</td>";
          $new= array("prenom" => $data[0], "nom"=> $data[1], "Choix" => array("Choix1" => $data[5], "Choix2" => $data[6], "Choix3" => $data[7],"Choix4" => $data[8],"Choix5" => $data[9],"Choix6" => $data[10]));


          }

          $tab = file_get_contents("temp.json");
          $old = json_decode($tab, true);
          array_push($old, $new);
          $final = json_encode($old);
          file_put_contents("temp.json", $final);


    }
    $raw++;
  }

  fclose($handle);

  echo $final;
 ?>
