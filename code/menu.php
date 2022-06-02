<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script type="text/javascript" src="admin.js"></script>
    <link rel="stylesheet" type="text/css" href="../styleAcceuil.css"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <?php
        session_start();
        $status = $_SESSION["status"];
        if ($status == "Admin") {
            ?>
            <div class="sidebar close">
        <div class="logo-details">
            <img src="../../data/CY_Tech.svg.png" alt="CY TECH">
            <span class="logo_name">TECH</span>
        </div>
        <ul class="nav-links">
        <li>
            <a href="#">
            <i class='bx bx-food-menu' onclick="window.location.href='../acceuil.php';"></i>
            <span class="link_name" onclick="window.location.href='../acceuil.php';">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../acceuil.php">Tableau de bord</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-user' onclick="window.location.href='../admin/changerInfo.php';"></i>
            <span class="link_name" onclick="window.location.href='../admin/changerInfo.php';">Profils</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="changerInfo.php">Profils</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
            <i class='bx bx-conversation' onclick="window.location.href='../messagerie/messagerie.php';"></i>
            <span class="link_name" onclick="window.location.href='../messagerie/messagerie.php';">Messagerie</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../messagerie/messagerie.php">Messagerie</a></li>
            </ul>
        </li>


        <li>
            <div class="profile-details">
            <div class="profile-content">
            <a href="#">
            <i class='bx bxs-log-out' ></i>
            <span class="link_name"><form method="POST" action="../connexion.php">
            <input class="bouton" type="submit" name="OUT" value="Deconnexion"/>
            </form></span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Déconnexion</a></li>
            </ul>

        </li>
        </ul>
        </div>
    <section class="home-section">
        <div class="home-content">
        <i class='bx bx-menu' style='color:#ffffff'  ></i>
        </div>
        <?php
        }

        if ($status == "Profs") {i
        ?>

            <div class="sidebar close">
        <div class="logo-details">
            <img src="../../data/CY_Tech.svg.png" alt="CY TECH">
            <span class="logo_name">TECH</span>
        </div>
        <ul class="nav-links">
        <li>
            <a href="#">
            <i class='bx bx-food-menu' onclick="window.location.href='../acceuil.php';"></i>
            <span class="link_name" onclick="window.location.href='../acceuil.php';">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../acceuil.php">Tableau de bord</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-user' onclick="window.location.href='../prof/changerInfo.php';"></i>
            <span class="link_name" onclick="window.location.href='../prof/changerInfo.php';">Profils</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="../prof/changerInfo.php">Profils</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-bug-alt' style='color:#f3eeee' onclick="window.location.href='../prof/sendTicket.php';"></i>
            <span class="link_name" onclick="window.location.href='../prof/sendTicket.php';">Tickets</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="../prof/sendTicket.php">Tickets</a></li>
            </ul>
        </li>

        <li>
            <a href="#">
            <i class='bx bx-conversation' onclick="window.location.href='../messagerie/messagerie.php';"></i>
            <span class="link_name" onclick="window.location.href='../messagerie/messagerie.php';">Messagerie</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../messagerie/messagerie.php">Messagerie</a></li>
            </ul>
        </li>


        <li>
            <div class="profile-details">
            <div class="profile-content">
            <a href="#">
            <i class='bx bxs-log-out' ></i>
            <span class="link_name"><form method="POST" action="../connexion.php">
            <input class="bouton" type="submit" name="OUT" value="Deconnexion"/>
            </form></span>
            </a>


        </li>
        </ul>
        </div>
        <section class="home-section">
        <div class="home-content">
        <i class='bx bx-menu' style='color:#ffffff'  ></i>
        </div>
        <?php
        } if ($status == "eleves") {
        ?>

        <div class="sidebar close">
        <div class="logo-details">
            <img src="../../data/CY_Tech.svg.png" alt="CY TECH">
            <span class="logo_name">TECH</span>
        </div>
        <ul class="nav-links">
        <li>
            <a href="#">
            <i class='bx bx-food-menu' onclick="window.location.href='../acceuil.php';"></i>
            <span class="link_name" onclick="window.location.href='../acceuil.php';">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../acceuil.php">Tableau de bord</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-trophy' onclick="window.location.href='../eleve/resultat_eleve.php';"></i>
            <span class="link_name" onclick="window.location.href='../eleve/resultat_eleve.php';">Résultats</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="../eleve/resultat_eleve.php">Résultats</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-user' onclick="window.location.href='../eleve/changerInfo.php';"></i>
            <span class="link_name" onclick="window.location.href='../eleve/changerInfo.php';">Profils</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="../eleve/changerInfo.php">Profils</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
            <a href="#">
            <i class='bx bx-bug-alt' style='color:#f3eeee' onclick="window.location.href='../eleve/sendTicket.php';"></i>
            <span class="link_name" onclick="window.location.href='../eleve/sendTicket.php';">Tickets</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="../eleve/sendTicket.php">Tickets</a></li>
            </ul>
        </li>

        <li>
            <a href="#">
            <i class='bx bx-conversation' onclick="window.location.href='../messagerie/messagerie.php';"></i>
            <span class="link_name" onclick="window.location.href='../messagerie/messagerie.php';">Messagerie</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="../messagerie/messagerie.php">Messagerie</a></li>
            </ul>
        </li>


        <li>
            <div class="profile-details">
            <div class="profile-content">
            <a href="#">
            <i class='bx bxs-log-out' ></i>
            <span class="link_name"><form method="POST" action="../connexion.php">
            <input class="bouton" type="submit" name="OUT" value="Deconnexion"/>
            </form></span>
            </a>


        </li>
        </ul>
        </div>
        <section class="home-section">
        <div class="home-content">
        <i class='bx bx-menu' style='color:#ffffff'  ></i>
        </div>
        <?php } ?>

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
