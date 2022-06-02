<?php
    session_start();
    $prenom = $_SESSION["prenom"];
    $nom = $_SESSION["nom"];
    $email = $_SESSION["email"];
    $pseudo = $_SESSION["pseudo"];
    $password = $_SESSION["password"];
    $status = $_SESSION["status"];
    $image = $_SESSION["image"];
    $filiere = $_SESSION["filiere"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modifier</title>
        <link rel="stylesheet" type="text/css" href="../formulaire.css"/>
        <link rel="icon" type="image/png" href="favicon.png"/>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- c'est jQuery-->
        <link rel="icon" type="image/png" href="../favicon.png"/>


    </head>
    <body>

      <div class="form">
        <h1>Modifier votre profil</h1>
        <div class="small-12 medium-2 large-2 columns">
       <?php
            echo "<div class='circle'>";
            echo "<img class='profile-pic' src=$image>";
            echo "</div>";
        ?>
      </div>
        <form action="enregistrerInfo.php" method="POST">       <!--TODO faire que l'on ne puisse pas modifier le nom et mail (et peut etre prenom si vous trouver ca mieux)-->
          <div class="input-container ic1">
            <?php
                echo "<input type='text' id='prenom' name='prenom' readonly class='input' value=$prenom>";
            ?>
            <div class="cut"></div>
            <label for="prenom" class="placeholder">Prénom</label>
            </div>
            <div class="input-container ic2">
            <?php
              //echo "<p class='input'>$nom</p>";
              echo "<input  type='text' id='nom' name='nom' class='input' value=$nom readonly placeholder=' '/>";
            ?>
              <div class="cut"></div>
              <label for="nom" class="placeholder">Nom</label>
            </div>
            <div class="input-container ic2">
            <?php
              //echo "<p class='input'>$email</p>";
              echo "<input  type='email' id='email' name='email' pattern='.+@cy-tech.fr' size='30' class='input' readonly value=$email  placeholder=' '/>";
            ?>
              <div class="cut"></div>
              <label for="email" class="placeholder">Email CY</label>
            </div>
            <div class="input-container ic2">
            <?php
              //echo "<p class='input'>$nom</p>";
              echo "<input  type='text' id='pseudo' name='pseudo' class='input' value=$pseudo placeholder=' '/>";
            ?>
              <div class="cut"></div>
              <label for="pseudo" class="placeholder">Pseudo</label>
            </div>
            <div class="input-container ic2">
            <?php
              echo "<input  type='password' id='password' name='password' class='input' required placeholder=' '/>";
            ?>
              <div class="cut"></div>
              <label for="password" class="placeholder">Mot de passe*</label>
            </div>
            <div class="input-container ic2">
                <?php

                    echo "<input  type='file' id='pp' name='pp' class='input' accept='image/*' placeholder=' '/>";
                ?>
                <div class="cut"></div>
                <label for="pp" class="placeholder">Photo de profil</label>

              <script type="text/javascript" src="photoModi.js"></script>
            </div>
            <p><input type="submit" value="Modifier" class="submit" required></p>
            <a href="accueilEleves.php">Retour</a>
        </form>
      </div>
    </body>
</html>
