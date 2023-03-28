<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["nom"])){ /*pas certain que ce soit utile*/
      header('Location: ../connexion.php');
    }
 ?>

 <html>
     <head>
         <meta charset="utf-8">
         <title>Ticket</title>
         <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
         <link rel="icon" type="image/png" href="../favicon.png"/>
         <script type="text/javascript" src="envoie.js"></script>

     </head>
     <body>
       <?php include "../menu.php"; ?>
       <div id=profil>

       </div>
       <h1>Remplissez votre ticket ci-dessous</h1>
       <div id=ticket>
           <p>Titre <input type="text" name="titre" id="titre"></p>
           <textarea name="description" id="description" rows="12" cols="35">Faites la description de votre problème.</textarea><br>
           <button type="button" onclick="envoyer()">Envoyer</button>
           <div id="etat">
           </div>
       </div>

     </body>
</html>
