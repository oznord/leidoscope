<?php
if (!isset($_REQUEST['action'])) 
    $action = "afficher" ;
else 
    $action = $_REQUEST['action'] ;

switch ($action)
{
    case 'authentification' : {  
            $login = $_POST['login'] ;
            $mdp = $_POST['mdp'] ;
            
            verifierIdentification($login, $mdp) ;

            header("Location: index.php?uc=accueil");

            break ;
        }

    case 'afficher' : {
            include("vue/v_authentification.php") ;
            break ;
        }
}

?>


