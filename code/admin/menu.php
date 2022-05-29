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
<div class="sidebar close">
        <div class="logo-details">
            <img src="../../data/CY_Tech.svg.png" alt="CY TECH">
            <span class="logo_name">TECH</span>
        </div>
        <ul class="nav-links">
        <li>
            <a href="#">
            <i class='bx bx-food-menu' onclick="window.location.href='accueilAdmin.php';"></i>
            <span class="link_name" onclick="window.location.href='accueilAdmin.php';">Tableau de bord</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="accueilAdmin.php">Tableau de bord</a></li>
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
            <i class='bx bx-user' onclick="window.location.href='changerInfo.php';"></i>
            <span class="link_name" onclick="window.location.href='changerInfo.php';">Profils</span>
            </a>
            </div>
            <ul class="sub-menu">
            <li><a class="link_name" href="changerInfo.php">Profils</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
            <i class='bx bx-conversation' onclick="window.location.href='messagerie.php';"></i>
            <span class="link_name" onclick="window.location.href='messagerie.php';">Messagerie</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="messagerie.php">Messagerie</a></li>
            </ul>
        </li>
        
        <li>
            <a href="#">
            <i class='bx bxs-log-out' ></i>
            <span class="link_name">Déconnexion</span>
            </a>
            <ul class="sub-menu blank">
            <li><a class="link_name" href="#">Déconnexion</a></li>
            </ul>
            <div class="profile-details">
            <div class="profile-content">
        </li>
        </ul>
        </div>
    <section class="home-section">
        <div class="home-content">
        <i class='bx bx-menu' style='color:#ffffff'  ></i>
        </div>

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