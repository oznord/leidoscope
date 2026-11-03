<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">

    <title>LEIDOSCOPE</title>

    <link href="includes/css/style.css" rel="stylesheet">
    
</head>
<body>
    <?php
    
    if (isset($_SESSION['login']))
    {
        echo ' 
    
    <div class="loader"></div>
    <div id="wrapper">
        
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                   Garage
                </a>
            </li>
            <li>
                <a href="index.php?uc=marque" id="bthome">Marques</a>
            </li>
            <li>
                <a href="index.php?uc=modele" id="bthome">Modèles</a>
            </li>
            <li>
                <a href="index.php?uc=deconnexion" id="admin">Déconnexion</a>
            </li>
        </ul>
    </nav>
        
    <div id="page-content-wrapper">
    <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
        <span class="hamb-top"></span>
    <span class="hamb-middle"></span>
    <span class="hamb-bottom"></span>
    </button>
        ' ;
    }
    ?>