<!--peut etre assemenbler les pages comme dans le cm7-->
<!DOCTYPE html>
<?php
  session_start();
  if (!isset($_SESSION["pseudo"])){
      header('Location: connexion.php');
  }

  if($_SESSION["status"] == "Profs")
  {
      header('Location: prof/accueilProf.php');
  }
  else if($_SESSION["status"] == "Admin")
  {
      header('Location: admin/accueilAdmin.php');
  }
  else
  {
      header('Location: eleve/accueilEleves.php');
  }
?>
