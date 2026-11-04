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
    if ($_REQUEST['uc']=='deconnexion') {
        session_destroy();
        header("Location:index.php");
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
