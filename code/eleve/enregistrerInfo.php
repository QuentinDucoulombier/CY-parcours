<?php
/*TODO on peut tjrs faire un appel ajax en cas d'erreur*/
    session_start();

    /*on change les infos dans la session pour le cas ou on fait juste retour*/
    $_SESSION["prenom"] = $_POST['prenom'];
    $_SESSION["nom"] = $_POST['nom'];
    $_SESSION["email"]= $_POST['email'];
    $_SESSION["password"]= password_hash($_POST['password'], PASSWORD_DEFAULT);
    $_SESSION["status"] = "eleves";
    if ($_SESSION['pp'] != NULL)
    {
        $_SESSION["image"] =  $_SESSION['pp'];
    }

    /*On modifie les infos dans le .csv*/
    $tab = array(); //on cree un tableau temporaire
    $cpt = 0;
    if (($handle = fopen("../../data/loginEleves.csv", "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
            if (($data[2] != $_POST["email"]) && ($data[1] != $_POST["nom"])) //on ne peut pas changer en theorie le mail et le nom
            {
                for ($c=0; $c < $num; $c++) {

                    array_push($tab, $data[$c]); //On enregistre dans un tableau les infos du .csv differente de celle de l'utilisateur modifier

                }
                $cpt ++; //compte le nombre de ligne differente de celle de l'utilisateur modifier
            }


        }
        fclose($handle);

    }
    /*on ecrase et recrit les ancienne info dans le loginEleves.csv*/
    $file = fopen("../../data/loginEleves.csv","w");
    foreach ((array_chunk($tab, ceil(count($tab) / $cpt))) as $value) { //array chunk permet de separet un tableau en plusieurs tableau (donc permet de separe le .csv en plusieurs lignes)
        fputcsv($file, $value, ";");                                    //lire https://www.php.net/manual/fr/function.array-chunk.php dans notre cas on prends la taille du tableau que l'on divise par le nombre d'utilisateur different de celui modifier
    }

    fclose($file);


    $file = fopen("../../data/loginEleves.csv","a");      //on rajoute les infos de l'utilisateur modifier a la fin

    if(!isset($_SESSION["pp"]))
    {
        $_SESSION["pp"] = "https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg"; //cas ou l'utilisateur ne choisis pas de pp
    }
    $list = array($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['pseudo'], $_SESSION["password"], $_SESSION["status"], $_SESSION["image"], $_SESSION["filiere"]);
    fputcsv($file, $list, ";");
    fclose($file);
    header('Location: accueilEleves.php'); //on redirige l'utilisateur vers la meme page
    exit();
?>
