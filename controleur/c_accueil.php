<?php
if (!isset($_REQUEST['action']))
	$action = "afficher" ;
else
	$action = $_REQUEST['action'] ;
	
switch ($action)
{
	case "afficher" : { 
            require "vue/v_vehiculev_accueil.php" ; 
            break ;             
        }
        
}
?>
