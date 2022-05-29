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
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript" src="admin.js"></script>

        <link rel="stylesheet" href="../messagerie/messagerie.css">
        <script src="../messagerie/messagerie.js"></script>
    </head>
    <body>

        <div class="sidebar close">
        <div class="logo-details">
            <img src="../../data/CY_Tech.svg.png" alt="CY TECH">
            <span class="logo_name">TECH</span>
        </div>
        <ul class="nav-links">
        <li>
            <a href="#">
            <i class='bx bx-food-menu'></i>
            <span class="link_name">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Tableau de bord</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-library'></i>
            <span class="link_name">Fonctionnalité</span>
            </a>
            </div>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Fonctionnalité</a></li>
            </ul>
        </li>
        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-user'></i>
            <span class="link_name">Profils</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="#">Profils</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
            <i class='bx bx-conversation'></i>
            <span class="link_name">Messagerie</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Messagerie</a></li>
            </ul>
        </li>
        
        <li>
        <div class="profile-details">
        <div class="profile-content">
        <i class='bx bxs-log-out' ></i>
    </li>
    </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
        <i class='bx bx-menu' ></i>
        </div>
        <?php

            $prenom =  $_SESSION["prenom"];
            $nom = $_SESSION["nom"];
            $status = $_SESSION["status"];
            $img = $_SESSION["image"];
            $email = $_SESSION["email"];
            //Creation de l'eleves en json
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


            echo "<h1>Bienvenue $prenom $nom vous etes $status</h1>";
            //echo "<img src=../$img></img>";
            echo "<a href=changerInfo.php><img class='pp' src=$img></img></a>";

        ?>
        <!-- TODO faire un menu changement info avec 2 possibilite (via la pp et via le menu dans la pp peut etre aussi mettre la deconnexion) -->


        <div id=createProfilEleve>
            <h2>Cree les profil eleves</h2>
            <button type="button" id="CreateEleve" onclick=test() >Lancer le programme</button>
            <div id=loading class="hidden">
                <p>Chargement merci de patienter ...</p>
                En attendant vous pouvez rigoler ici :<button onclick="popup()">Fun</button><br />
                <div class="loadingio-spinner-double-ring-lroiipoijrl"><div class="ldio-ys48lrawjtg">
                <div></div>
                <div></div>
                <div><div></div></div>
                <div><div></div></div>
                </div></div>

            </div>
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
                    echo "<input type='hidden' id='rowPost' name='rowPost' value=$row>";
                    fclose($handle);
                }
                echo "</table>";
                echo "</div>";
            ?>
            <p></p>
            Ticket resolu :
            <?php
                echo "<select name='bug' id='bug'>";
                echo "<option value=''>Ticket à supprimer</option>";
                $row=0;
                if (($handle = fopen("../../data/error.csv", "r")) !== FALSE) {
                    
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $num = count($data);
                        if($row > 0)
                        {
                        echo "<option value=$data[3]>$data[3]</option>";
                        }
                        $row++;
                    }
                    fclose($handle);
                    
                }
                echo "</select>";
            ?>
            <button type="button" onclick="ticket()">Envoyer</button>
            <div id="etat">
            </div>



        </div>
        <div id="log">
            
            <?php
                $row=0;
                if(file_exists("../../data/logOption.csv"))
                {
                    echo "<h3>Log des modifications des profs</h3>";
                    if (($handle = fopen("../../data/logOption.csv", "r")) !== FALSE) {
                        echo "<table>";
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            $num = count($data);
                            if($row == 0)
                            {
                                echo "<tr>";
                                for ($c=0; $c < $num; $c++) {
                                    echo "<th>$data[$c]</th>";
                                }
                                echo "</tr>";
                            }
                            else
                            {
                                echo "<tr>";
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
                }
                
            ?>
        </div>

        <div id="report">
            <h3>Signalement messagerie</h3>
            <?php
                
               
                $data = file_get_contents("../messagerie/logs/ticket_message.json");
                $data_json = json_decode($data,TRUE);
                $taille = $data_json["nb_ticket"];
                
                echo "<table>";
                echo "<tr>";
                echo "<th>Date</th>";
                echo "<th>Auteur</th>";
                echo "<th>Signalé par</th>";
                echo "<th>Motif</th>";
                echo "<th>Description</th>";
                
                echo "</tr>";
                for ($i=0; $i < $taille ; $i++) { 
                    echo "<tr>";
                    echo "<td>".$data_json['tickets'][$i]['message']['infos']['date']." ".$data_json['tickets'][$i]['message']['infos']['heure']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['message']['auteur']['statut']." : ".$data_json['tickets'][$i]['message']['auteur']['nom']." ".$data_json['tickets'][$i]['message']['auteur']['prenom']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['message']['destinataire']['statut']." : ".$data_json['tickets'][$i]['message']['destinataire']['nom']." ".$data_json['tickets'][$i]['message']['destinataire']['prenom']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['motif']."</td>";
                    echo "<td>".$data_json['tickets'][$i]['description']."</td>";
                    echo "</tr>";
                }
                echo "</table>";
                
                   
            ?>

        </div>
        <p></p>

        <div id="profil">
            <h2>Modifier votre profil :
            <a href="changerInfo.php">Ici</a></h2>
        </div>


        <div id="messagerie-container">
            <div id="option-plus"  class="hidden">
                <div id="supprimer" class="">Suprimer</div>
                <div id="signaler" class="hidden">Signaler</div>
            </div>

            <form id="signalement" class="hidden">
                <p>Motif du signalement:</p>
                <select id="motif" >
                    <option>Méchant !</option>
                    <option>Très méchant :< </option>
                    <option>Vraiment très méchant 😡 GRAOUU ! </option>
                </select>
                <p>Descrition du signalement(facultatif):</p>
                <textarea id="description" rows="5" cols="33"></textarea>
                <div id="les-boutons">
                    <div>Signaler</div> <div onclick="annuler_signal()">Annuler</div>
                </div>
            </form>

            <div id="les-discussions">

                <select id="select-discussion" size="5">
                    <optgroup label="Professeurs">
                    <?php
                    if (($handle = fopen("../../data/loginProf.csv", "r")) !== FALSE) {
                        $data = fgetcsv($handle, 1000, ";");
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                        }
                        fclose($handle);
                    }
                    ?>
                    </optgroup>
                    <optgroup label="Eleves">
                    <?php
                    if (($handle = fopen("../../data/loginEleves.csv", "r")) !== FALSE) {
                        $data = fgetcsv($handle, 1000, ";");
                        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                        }

                        fclose($handle);
                    }
                    ?>
                    </optgroup>
                    <optgroup label="Admins">
                      <?php
                      if (($handle = fopen("../../data/loginAdmin.csv", "r")) !== FALSE) {
                          $data = fgetcsv($handle, 1000, ";");
                          while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                              echo '<option onclick=nouv_autre("'.$data[1].'","'. $data[0].'","'.$data[2].'","'.$data[5].'") value="'.$data[0].' '. $data[1].'">'.$data[0].' '. $data[1].'</option>' ;
                          }

                          fclose($handle);
                      }
                      ?>
                    </optgroup>
                </select>

            </div>

            <div id="la-discussion">
                <div id="message-zone">
                    <div class="message envoye">
                        <div class="premiere-ligne">
                            <p class="auteur">Jean Michel</p>
                            <div class="plus">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>

                        <p class="infos">18/04/2022 23:17:03</p>

                        <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde veniam aspernatur ducimus, dolor, temporibus magni explicabo voluptatem non totam itaque atque aut quos? Numquam, Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet inventore repellendus exercitationem corrupti excepturi! Veniam hic omnis, vel unde quos blanditiis atque perferendis! Nemo veritatis magnam laudantium incidunt. Autem, neque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim temporibus inventore sit adipisci ducimus deleniti quos nam repellendus asperiores. Eos alias, deserunt aperiam cum quisquam dolores iusto hic iste numquam? fugiat nesciunt deleniti doloremque reiciendis delectus. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam libero numquam vel illum dignissimos. Consectetur maiores repellendus quas placeat velit nemo atque ipsa earum! Modi quaerat itaque nisi quos consequatur. !</p>
                    </div>
                </div>
                <div id="bas-messagerie">
                    <div id="nouv-message">
                        <input id="message-text" type="text" value="">
                        <button onclick="nouveau_message()">Envoyer</button>
                    </div>
                    <div class="button-bloque-debloque" id="button-bloque" onclick="bloquer_utilisateur()">
                        Bloquer l'utilisateur
                    </div>
                    <div class="button-bloque-debloque hidden" id="button-debloque" onclick="debloquer_utilisateur()">
                        Débloquer l'utilisateur
                    </div>
                </div>
            </div>
        </div>


        <form method="POST" action="../connexion.php">
            <input type="submit" name="OUT" value="Deconnexion"/>
        </form>



        <script>

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            async function verification_message() {
                recup_messages();
                //console.log(id_dernier_message);
                await sleep(1000);
                verification_message();
            }
            verification_message();
        </script>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".bx-menu");
        console.log(sidebarBtn);
        sidebarBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
        });
    </script>





        
        
    </body>
</html>
