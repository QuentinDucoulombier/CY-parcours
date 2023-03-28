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
        <title>Accueil</title>
        <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
        <link rel="icon" type="image/png" href="../favicon.png"/>
        <script type="text/javascript" src="../mariageStable/stable.js"></script>
        <script type="text/javascript" src="prof.js"></script>


    </head>
    <body>
        <?php
            include "../menu.php";
            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $email = $_SESSION["email"];
            $_SESSION["user"] ='{
                "nom":"'.$nom.'",
                "prenom":"'.$prenom.'",
                "adresse_mail":"'.$email.'",
                "statut":"'.$status.'"
            }';
            $_SESSION["autre"] =  '{
                "nom":"Grandisson",
                "prenom":"Brewal",
                "adresse_mail":"Lajeunesse@cytech.fr",
                "statut":"eleve"
            }';

            echo "<h1>Bienvenue $prenom $nom</h1>";
            //echo "<img src=../$img></img>";
            echo "<a href=changerInfo.php><img class='pp' src=$img></img></a>";

        ?>
        <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->

        <div id=mariage>
        <div id=mariage>
            <button class="bouton" onclick="doMarriage(1), message('GSI')">Lancer le mariage stable GSI</button>
            <button class="bouton" onclick="doMarriage(2), message('MI')">Lancer le mariage stable MI</button>
            <button class="bouton" onclick="doMarriage(3), message('MF')">Lancer le mariage stable MF</button>
        </div>
        </div>


        <div id="change">
        <h2 >Changer la filière d'un élève :</h2>
            <select name='filiere' id='filiere' size=4>
                <option value=''>Choisir la specialité de l'élève</option>
                <option value='GSI' onclick="filiere('GSI')">GSI</option>
                <option value='MI' onclick="filiere('MI')">MI</option>
                <option value='MF' onclick="filiere('MF')">MF</option>
            </select>
            <div id="listEleveFiliere" >
            </div>
            <div id="filiereEleve">
            </div>
            <div id="etat">
            </div>
            <div id=validation style="margin-top: 1em">
            <button class="bouton" onclick="Valider()">Valider les choix et envoyer le resultat aux étudiants</button>
        </div>
        </div>


        <div id=stats>
            <button class="bouton" onclick="moyennes('GSI')">Afficher les stats GSI</button>
            <button class="bouton" onclick="moyennes('MI')">Afficher les stats MI</button>
            <button class="bouton" onclick="moyennes('MF')">Afficher les stats MF</button>
            <p></p>
            <div id="resultatStats">
            </div>
        </div>




    </body>
</html>
