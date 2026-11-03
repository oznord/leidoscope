<?php
session_start();
ob_start();
date_default_timezone_set('Europe/Paris');


if (!isset($_REQUEST['uc']))
{
    echo '<title>LEIDOSCOPE</title>';
    include "vues/v_authentification.php" ;
    
}
else
{
    if ($_REQUEST['uc']=='decnx') {
        session_destroy();
        header("Location:index.php");
    } else {

        include "includes/modele/connexion.php" ;
        include "includes/modele/gestion_bdd.php" ;
        
        $action = $_REQUEST['action'] ?? '';
        if (in_array($action, ['connexion'])) {

            include "controleurs/c_principal.php";
        } else {

            echo '<title>LEIDOSCOPE</title>';
            include "includes/header.php" ; 
            include "controleurs/c_principal.php" ; 
            include "includes/footer.php" ;
            if (ob_get_level()) {
                ob_end_flush();
            }
        }
    }
}
?>
