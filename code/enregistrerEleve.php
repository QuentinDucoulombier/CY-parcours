<?php
    session_start();
    function enregistre($fichier, $filiere)
    {
        if (($handle = fopen($fichier, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {


                if (($data[2] == $_POST["email"]) && ($data[1] == $_POST["nom"])){  //On verifie si son adresse mail et son nom existe dans la base de donnée

                    if(!file_exists("../data/loginEleves.csv"))
                    {
                        $file = fopen("../data/loginEleves.csv","w");
                        $listeTitre = array("Prenom","Nom","Email","pseudo","mdp","status", "pp", "filiere");
                        fputcsv($file, $listeTitre, ";");
                        fclose("../data/loginEleves.csv");

                    }

                    //on importe les infos de l'inscription dans un csv
                    $file = fopen("../data/loginEleves.csv","a");
                    if(!isset($_SESSION["pp"]))
                    {
                        $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisit pas de pp
                    }
                    $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_POST['password'], "eleves", $_SESSION["pp"], $filiere);
                    fputcsv($file, $list, ";");
                    fclose($file);
                    header('Location: connexion.php');
                    exit();
                }
                else
                {
                header('Location: inscription.html'); //TODO mettre un msg d'erreur (en ajax en gros)
                }
            }
            fclose($handle);
        }
    }
    enregistre("../data/choixEtudiantsParcours1.csv","GSI");
    enregistre("../data/choixEtudiantsParcours2.csv","MF");
    enregistre("../data/choixEtudiantsParcours3.csv","MI");

?>
