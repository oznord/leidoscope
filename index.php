<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Paris');


if (!isset($_REQUEST['uc']))
{
    echo '<title>LEIDOSCOPE</title>';
    include "vue/v_authentification.php" ;
    
}
else
{
    if ($_REQUEST['uc']=='decnx') {
        session_destroy();
        header("Location:index.php");
    } else {

        include "include/modele/connexion.php" ;
        include "include/modele/gestion_bdd.php" ;
        
        $action = $_REQUEST['action'] ?? '';
        if (in_array($action, ['connexion'])) {

            include "controleur/c_principal.php/?uc=authentification";
        } else {

            echo '<title>LEIDOSCOPE</title>';
            include "include/header.php" ; 
            include "controleur/c_principal.php" ; 
            include "include/footer.php" ;
            if (ob_get_level()) {
                ob_end_flush();
            }
        }
    }
}
?>
