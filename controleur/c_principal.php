<?php
if (!isset($_REQUEST['uc'])) {
    $uc = "accueil" ;
}
else {
    $uc = $_REQUEST['uc'] ;
}

switch ($uc)
{
    case 'authentification' : { include "c_authentification.php"; break; }
    case 'deconnexion' : {  include "c_deconnexion.php" ; break ; }
    case 'accueil' : {  include "c_accueil.php" ; break ; }
}

?>
