<?php
$handle = fopen("../data/choixEtudiantsParcours3.csv", "r");

$raw=0;
$vide = "[]";
file_put_contents("temp.json", $vide);
  while (($data = fgetcsv($handle, 1000, ";"))) {
    if ($raw > 0) {

        for ($i=0; $i < 11; $i++) {
          //echo "<td>".$data[$i]."</td>";
          $new= array("prenom" => $data[0], "nom"=> $data[1], "Choix" => array("Choix1" => explode(" ",$data[5])[0], "Choix2" => explode(" ",$data[6])[0], "Choix3" => explode(" ",$data[7])[0],"Choix4" => explode(" ",$data[8])[0],"Choix5" => explode(" ",$data[9])[0],"Choix6" => explode(" ",$data[10])[0]));


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
