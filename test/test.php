<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Le Titre</title>

        <script type="text/javascript" src="test.js"></script> <!--Soit ici soit en bas-->
    </head>
    <body>
        <h1>test</h1>
        <!--Regarde les log fdp-->
        <?php
        $handle = fopen("../data/choixEtudiantsParcours3.csv", "r");
        echo "<table>";
        $raw=0;
        $vide = "[]";
        file_put_contents("temp.json", $vide);
          while (($data = fgetcsv($handle, 1000, ";"))) {
            if ($raw > 0) {
              echo "<tr>";
                for ($i=0; $i < 11; $i++) {
                  //echo "<td>".$data[$i]."</td>";
                  $new= array("prenom" => $data[0], "nom"=> $data[1], "Choix1" => $data[5], "Choix2" => $data[6], "Choix3" => $data[7],"Choix4" => $data[8],"Choix5" => $data[9],"Choix6" => $data[10]);


                  }

                  $tab = file_get_contents("temp.json");
                  $old = json_decode($tab, true);
                  array_push($old, $new);
                  $final = json_encode($old);
                  file_put_contents("temp.json", $final);

              echo "</tr>";
            }
            $raw++;
          }
          echo "</table>";
          fclose($handle);


          ?>
    </body>

</html>
