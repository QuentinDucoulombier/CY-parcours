<?php
    $handle = fopen("../../data/nbPLacesParcours.csv", "r");
    $filiere = $_POST["filiere"];
  $raw=0;
  $array = [];
  while (($data = fgetcsv($handle, 1000, ";"))) {
    if ($raw > 0) {

      $new = array("spe" => $data[0], "nbPlace"=> $data[$filiere]);

      array_push($array, $new);
    }
    $raw++;
  }
  fclose($handle);

  $final = json_encode($array);

  echo $final;
 ?>
