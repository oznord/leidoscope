<?php
/**
 * Vérifie les identifiants de connexion et instancie les variables de session
 
 * @param $loginSaisi 
 * @param $mdpSaisi
 * @return un boolÃ©en true si utilisateur connu, false sinon 
*/
function verifierIdentification($loginSaisi, $mdpSaisi) {
    require "connexion.php" ;
    $sql="select login, mdp from utilisateur
          where login = ? and mdp = ?" ;
    $exec=$bdd->prepare($sql);
    $data= [strtoupper($loginSaisi), MD5($mdpSaisi)];
    $trouve = false ;
    $exec->execute($data) ;
    $ligne=$exec->fetch();
    if ($exec->rowCount() > 0) {
        $trouve = true ;
        $_SESSION['login']=$ligne['login'] ;
        $_SESSION['mdp']=$ligne['mdp'] ;
    }

    return $trouve ;
}

?>