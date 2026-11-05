<?php
if (!isset($_REQUEST['action'])) 
    $action = "afficher" ;
else 
    $action = $_REQUEST['action'] ;

switch ($action)
{
    case 'authentification' : {  
        $login = trim($_POST['login'] ?? '');
        $mdp = $_POST['mdp'] ?? '';
            
            $emailValide = preg_match('/^[^@\s]+@[^@\s]+\.[^@\s]+$/', $login);
            $motDePasseValide = preg_match('/^(?=.*[^A-Za-z0-9\s]).{12,}$/', $mdp);


            if ($emailValide && $motDePasseValide && verifierIdentification($login, $mdp)) {
                session_regenerate_id(true);

                header("Location: index.php?uc=accueil");
                exit;
            }


            $erreur = (!$emailValide || !$motDePasseValide)
                ? "L'adresse mail ou le mot de passe ne respecte pas le format attendu."
                : "Identifiants invalides.";
            include("vue/v_authentification.php") ;

            break ;

        }

    case 'afficher' : {
            include("vue/v_authentification.php") ;
            break ;
        }
}

?>
