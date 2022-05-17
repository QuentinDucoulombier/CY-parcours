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
        <script type="text/javascript" src="admin.js"></script>

    </head>
    <body>
        <?php

            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
           $img = $_SESSION["image"];
            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            //echo "<img src=../$img></img>";
            echo "<a href=changerInfo.php><img src=$img></img></a>";

        ?>
        <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->
        <div id=menu>
            <h2>Menu</h2>
            <ul>
                <li>test</li>
                <li>test2</li>
            </ul>
        </div>
        
        <div id=createProfilEleve>
            <h2>Cree les profil eleves</h2>
            <button type="button" id="CreateEleve" onclick=test() >Lancer le programmes</button>
        </div>
        <h2>Tableau de bord</h2>
        <div id=modif>
            <h3>Ticket/erreur</h3>
            <?php
                echo "<div id='actualisation'>";
                $row=0;
                if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
                    echo "<table>";
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row == 0)
                        {
                            echo "<tr>";
                            echo "<th>Numero</th>";
                            for ($c=0; $c < $num; $c++) {
                                echo "<th>$data[$c]</th>";
                            }  
                            echo "</tr>";
                        }
                        else
                        {
                            echo "<tr>";
                            echo "<td>$row</td>";
                            for ($c=0; $c < $num; $c++) {
                                echo "<td>$data[$c]</td>";
                            }
                            echo "</tr>";
                        }
                        $row++;
                    }
                    fclose($handle);
                }
                echo "</table>";
                echo "</div>";
            ?>
            <p></p>
            Ticket resolu :
            <?php
                echo "<input list='Bug' name='bug' id='bug'/>";
                $row=0;
                if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
                    echo "<datalist id='Bug'>";
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row > 0)
                        {
                        echo "<option value=$data[0]>";
                        }
                        $row++;
                    }
                    fclose($handle);
                    echo "</datalist>";
                }
            ?>
            <button type="button" onclick="ticket()">Envoyer</button>
            <div id="etat">
            </div>

        

        </div>
        <div id="log">
            <h3>Log des modifications des profs</h3>
        </div>
        <p></p>

        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="deconnexion"/>
        </form>
    </body>
</html>
