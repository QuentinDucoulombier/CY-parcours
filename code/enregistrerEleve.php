<?php
    session_start();
    if (($handle = fopen("../data/choixEtudiantsParcours1.csv", "r")) !== FALSE) { //TODO : etendre au autre fichier (choixEtudiantsParcours2 et choixEtudiantsParcours3)
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    
    
            if (($data[2] == $_POST["email"]) && ($data[1] == $_POST["nom"])){  //On verifie si son adresse mail et son nom existe dans la base de donnée
               
                if(!file_exists("../data/loginEleves.csv"))
                {
                    $file = fopen("../data/loginEleves.csv","w");
                    $listeTitre = array("Prenom","Nom","Email","pseudo","mdp");
                    fputcsv($file, $listeTitre, ";");
                    fclose("../data/loginEleves.csv");
    
                }
                
                //on importe les infos de l'inscription dans un csv
                $file = fopen("../data/loginEleves.csv","a");
                $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_POST['password']);
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
?>

