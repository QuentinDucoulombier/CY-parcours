<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["pseudo"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
  }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceuil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>

    </head>
    <body>
        <?php

            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $email = $_SESSION["email"];
            $filiere = $_SESSION["filiere"];
            echo "<h1>Bienvenue $prenom $nom, vous êtes $status votre filiere : $filiere</h1>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";
            $verif = false;


            if (($eleve = fopen('../../data/choixEtudiantsParcours1.csv','r')) && ($filiere == "GSI")) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10],$l[11],$l[12]];
                        $nbChoix = 8;
                    }
                }
            }
            if (($eleve = fopen('../../data/choixEtudiantsParcours2.csv','r')) && ($filiere == "MF")){
              echo "test";
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6]];
                        $nbChoix = 2;
                    }
                }
            }
            if (($eleve = fopen('../../data/choixEtudiantsParcours3.csv','r')) && ($filiere == "MI")) { //on peut faire une fonction la pour que ce soit plus propre en sah
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10]];
                        $nbChoix = 6;
                    }
                }
            }

        ?>
         <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
        <div id=menu>
            Menu <br>
            <ul>
                <li>Votre moyenne : <span><?php echo $moyenne; ?></span></li>
                <li>Vos ECTS : <span><?php echo $ects; ?></span></li>
                <li>Vos options :<ul>
                  <?php
                  for ($i = 0; $i < $nbChoix; $i++) {
                    $j = $i+1;
                    echo "<li>Choix $j : <span> $choix[$i] </span></li>";
                  } ?>
                </ul>
              </li>
            </ul>
        </div>
        <div id=profil>

        </div>
        <p></p>

        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
        </form>
    </body>
</html>
