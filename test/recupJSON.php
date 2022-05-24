<?php
  $handle = fopen("../data/choixEtudiantsParcours3.csv", "r");

  $raw=0;
  $array = [];
  while (($data = fgetcsv($handle, 1000, ";"))) {
    if ($raw > 0) {


      $new = array("prenom" => $data[0], "nom"=> $data[1], "Choix" => array("Choix1" => explode(" ",$data[5])[0], "Choix2" => explode(" ",$data[6])[0], "Choix3" => explode(" ",$data[7])[0],"Choix4" => explode(" ",$data[8])[0],"Choix5" => explode(" ",$data[9])[0],"Choix6" => explode(" ",$data[10])[0]));

      array_push($array, $new);


    }
    $raw++;
  }
  fclose($handle);

  $final = json_encode($array);
  file_put_contents("temp.json", $final);

  echo $final;
 ?>
