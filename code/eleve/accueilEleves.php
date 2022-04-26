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
            echo "<h1>Bienvenue $prenom $nom, vous êtes $status</h1>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";
            $verif = false;

            if ($eleve = fopen('../../data/choixEtudiantsParcours1.csv','r')) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10]];
                        $verif = true;
                    }
                }
            }
            if (($eleve = fopen('../../data/choixEtudiantsParcours2.csv','r')) && (!$verif)) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10]];
                        $verif = true;
                    }
                }
            }
            if (($eleve = fopen('../../data/choixEtudiantsParcours3.csv','r')) && (!$verif)) {
                while (($l = fgetcsv($eleve, 1024, ";")) !== (FALSE)) {
                    if($email == $l[2]){
                        $moyenne = $l[4];
                        $ects = $l[3];
                        $choix = [$l[5],$l[6],$l[7],$l[8],$l[9],$l[10]];
                        $verif = true;
                    }
                }
            }
        ?>
         <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
        <div id=menu>
            Menu
            <ul>
                <li>Votre moyenne : <span><?php echo $moyenne; ?></span></li>
                <li>Vos ECTS : <span><?php echo $ects; ?></span></li>
                <li>Vos options :<ul>
                    <li>Choix 1 : <span><?php echo $choix[0]; ?></span></li>
                    <li>Choix 2 : <span><?php echo $choix[1]; ?></span></li>
                    <li>Choix 3 : <span><?php echo $choix[2]; ?></span></li>
                    <li>Choix 4 : <span><?php echo $choix[3]; ?></span></li>
                    <li>Choix 5 : <span><?php echo $choix[4]; ?></span></li>
                    <li>Choix 6 : <span><?php echo $choix[5]; ?></span></li>
                </ul></li>
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