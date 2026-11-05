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
    }

    return $trouve ;
}

/**
 * Vérifie le rôle de l'utilisateur
 
 * @param $loginSaisi
 * @return un boolÃ©en true si utilisateur connu, false sinon 
*/
function verifierRole($loginSaisi) {
    require "connexion.php" ;
    $sql="select role from utilisateur
          where login = ?" ;
    $exec=$bdd->prepare($sql);
    $data= [strtoupper($loginSaisi)];
    $exec->execute($data) ;
    $ligne=$exec->fetch();

    return $ligne['role'];
}

/**
 * Récupère les formations selon les filtres du catalogue.
 *
 * @return array<int, array<string, mixed>>
 */
function recupererFormations($motCle = '', $categorie = '', $date = '') {
    global $bdd;

    $sql = "SELECT f.id, f.intitule, c.libelle AS categorie, f.`date`,
                   f.horaire, f.lieu, f.places, f.inscrits
            FROM formation f
            INNER JOIN categorie c ON c.id = f.id_categorie
            WHERE 1 = 1";
    $parametres = [];

    if ($motCle !== '') {
        $sql .= " AND (f.intitule LIKE :mot_cle_intitule
                  OR c.libelle LIKE :mot_cle_categorie
                  OR f.lieu LIKE :mot_cle_lieu)";
        $motCleParametre = '%' . $motCle . '%';
        $parametres['mot_cle_intitule'] = $motCleParametre;
        $parametres['mot_cle_categorie'] = $motCleParametre;
        $parametres['mot_cle_lieu'] = $motCleParametre;
    }

    if ($categorie !== '') {
        $sql .= " AND c.id = :categorie";
        $parametres['categorie'] = $categorie;
    }

    if ($date !== '') {
        $sql .= " AND f.`date` = :date";
        $parametres['date'] = $date;
    }

    $sql .= " ORDER BY f.`date` ASC, f.horaire ASC";

    $requete = $bdd->prepare($sql);
    $requete->execute($parametres);

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère les catégories présentes dans les formations.
 *
 * @return array<int, array<string, mixed>>
 */
function recupererCategoriesFormations() {
    global $bdd;

    $requete = $bdd->query(
        "SELECT DISTINCT c.id, c.libelle
         FROM formation f
         INNER JOIN categorie c ON c.id = f.id_categorie
         ORDER BY c.libelle ASC"
    );

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupère les utilisateurs présents dans la base de données.
 *
 * @return array<int, array<string, mixed>>
 */
function recupererUtilisateurs() {
    global $bdd;

    $requete = $bdd->query(
        "SELECT *
         FROM utilisateur
         ORDER BY role DESC"
    );

    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

?>