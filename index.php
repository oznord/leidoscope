<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Paris');


if (!isset($_REQUEST['uc']))
{
    echo '<title>LEIDOSCOPE</title>';
    include "include/header_de_base.php";
    include "controleur/c_principal.php";
    include "include/footer.php" ;
}
else
{
    $uc = $_REQUEST['uc'];

    if ($uc === 'deconnexion') {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    if ($uc !== 'authentification') {
        if (!isset($_SESSION['login'])) {
            header("Location: index.php?uc=authentification");
            exit;
        }
    }

    if ($uc === 'authentification') {
        include "include/modele/connexion.php" ;
        include "include/modele/gestion_bdd.php" ;

        echo '<title>LEIDOSCOPE</title>';
        include "include/header_de_base.php" ;
        include "controleur/c_principal.php" ;
        include "include/footer.php" ;
        if (ob_get_level()) {
            ob_end_flush();
        }
    } else {

        include "include/modele/connexion.php" ;
        include "include/modele/gestion_bdd.php" ;

        echo '<title>LEIDOSCOPE</title>';
        include "include/header.php" ;
        include "controleur/c_principal.php" ;
        include "include/footer.php" ;
        if (ob_get_level()) {
            ob_end_flush();
        }
    }
}
?>
