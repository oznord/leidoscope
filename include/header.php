<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>LEIDOSCOPE</title>

    <link href="include/css/style.css" rel="stylesheet">
    
</head>
<body>

<nav>
<div class='nav-gauche'>
    <li>
        <a class='nav-marque' href="/index.php?uc=accueil">
            <img class='nav-logo' src="/include/img/logo.png" alt="logo" />
            <span class='nav-titre'>Leidoscope</span>
        </a>
    </li>
    <li><a href="/index.php?uc=catalogue"><span>Catalogue</span></a></li>
</div>
<div class='nav-droite'>
    <li><a href="/index.php?uc=deconnexion"><span>Se déconnecter</span></a></li>
</div>
</nav>

    <?php
    
    if (isset($_SESSION['login']))
    {
        echo ' ';
    }
    ?>
</body>