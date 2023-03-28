<?php
  if ($_POST["filiere"] == 1) {
    $handle = fopen("../../data/choixEtudiantsParcours1.csv", "r");
    $nb_choix = 8;
  }
  if ($_POST["filiere"] == 3) {
    $handle = fopen("../../data/choixEtudiantsParcours2.csv", "r");
    $nb_choix = 2;
  }
  if ($_POST["filiere"] == 2) {
    $handle = fopen("../../data/choixEtudiantsParcours3.csv", "r");
    $nb_choix = 6;
  }

  $raw=0;
  $array = [];
  while (($data = fgetcsv($handle, 1000, ";"))) {
    if ($raw > 0) {
      $choix = [];
      for ($i=1; $i < $nb_choix+1 ; $i++) {
        $new_choix = array("Choix".$i => explode(" ",$data[4+$i])[0]);
        $choix = array_merge($choix,$new_choix);
      }

      $new = array("prenom" => $data[0], "nom"=> $data[1],"mail"=> $data[2] , "moyenne" => $data[4], "Choix" => $choix);

      array_push($array, $new);
    }
    $raw++;
  }
  fclose($handle);

  $final = json_encode($array);

  echo $final;
 ?>
