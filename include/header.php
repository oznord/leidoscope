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
    <li class='nav-marque'>
        <img class='nav-logo' src="/include/img/logo.png" alt="logo" />
        <span class='nav-titre'>Leidoscope</span>
    </li>
</div>
<div class='nav-droite'>
    <li><span>Formations</span></li>
    <li><span>Ateliers</span></li>
</div>
</nav>

    <?php
    
    if (isset($_SESSION['login']))
    {
        echo ' ';
    }
    ?>
</body>