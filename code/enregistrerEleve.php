<?php
    session_start();
    function enregistre($fichier)
    {
        if (($handle = fopen($fichier, "r")) !== FALSE) { 
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        
        
                if (($data[2] == $_POST["email"]) && ($data[1] == $_POST["nom"])){  //On verifie si son adresse mail et son nom existe dans la base de donnée
                
                    if(!file_exists("../data/loginEleves.csv"))
                    {
                        $file = fopen("../data/loginEleves.csv","w");
                        $listeTitre = array("Prenom","Nom","Email","pseudo","mdp","status", "pp");
                        fputcsv($file, $listeTitre, ";");
                        fclose("../data/loginEleves.csv");
        
                    }
                    
                    //on importe les infos de l'inscription dans un csv
                    $file = fopen("../data/loginEleves.csv","a");
                    $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_POST['password'], "eleves", $_SESSION["pp"]);
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
    enregistre("../data/choixEtudiantsParcours1.csv");
    enregistre("../data/choixEtudiantsParcours2.csv");
    enregistre("../data/choixEtudiantsParcours3.csv");

?>

