<?php
/**
 * Vérifie les identifiants de connexion et instancie les variables de session
 
 * @param $loginSaisi 
 * @param $mdpSaisi
 * @return un boolÃ©en true si utilisateur connu, false sinon 
*/
function verifierIdentification($loginSaisi, $mdpSaisi) {
    require "connexion.php" ;
    $sql="select id, login, mdp, role from utilisateur
          where login = ? and mdp = ?" ;
    $exec=$bdd->prepare($sql);
    $data = [trim($loginSaisi), md5($mdpSaisi)];
    $exec->execute($data);
    $ligne=$exec->fetch();

    if ($ligne !== false) {
        $_SESSION['utilisateur_id'] = (int) $ligne['id'];
        $_SESSION['login'] = $ligne['login'];
        $_SESSION['role'] = $ligne['role'];
        return true;
    }

    return false;
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

/*
 * Récupère une formation pour afficher sa fiche détail.
 */
function recupererFormation($idFormation) {
    global $bdd;

    $requete = $bdd->prepare(
        "SELECT f.id, f.intitule, f.description, f.`date`, f.horaire,
                f.lieu, f.formateur, f.places, f.inscrits, c.libelle AS categorie
         FROM formation f
         INNER JOIN categorie c ON c.id = f.id_categorie
         WHERE f.id = :id"
    );
    $requete->execute(['id' => $idFormation]);

    $formation = $requete->fetch(PDO::FETCH_ASSOC);
    return $formation ?: null;
}

/**
 * Vérifie si un salarié est déjà inscrit sur le même créneau.
 */
function salarieADejaUnCreneau($idUtilisateur, $idFormation) {
    global $bdd;

    $requete = $bdd->prepare(
        "SELECT COUNT(*)
         FROM inscription i
         INNER JOIN formation f ON f.id = i.id_formation
         INNER JOIN formation nouvelle_formation
             ON nouvelle_formation.id = :id_formation
         WHERE i.id_utilisateur = :id_utilisateur
           AND f.`date` = nouvelle_formation.`date`
           AND f.horaire = nouvelle_formation.horaire"
    );
    $requete->execute([
        'id_utilisateur' => $idUtilisateur,
        'id_formation' => $idFormation
    ]);

    return (int) $requete->fetchColumn() > 0;
}

/**
 * Inscrit un salarié à une formation après les vérifications nécessaires.
 */
function inscrireSalarie($idUtilisateur, $idFormation) {
    global $bdd;

    $bdd->beginTransaction();

    try {
        $requete = $bdd->prepare(
            "SELECT places, inscrits
             FROM formation
             WHERE id = :id
             FOR UPDATE"
        );
        $requete->execute(['id' => $idFormation]);
        $formation = $requete->fetch(PDO::FETCH_ASSOC);

        if ($formation === false) {
            $bdd->rollBack();
            return 'introuvable';
        }

        if ((int) $formation['inscrits'] >= (int) $formation['places']) {
            $bdd->rollBack();
            return 'complet';
        }

        if (salarieADejaUnCreneau($idUtilisateur, $idFormation)) {
            $bdd->rollBack();
            return 'conflit';
        }

        $requete = $bdd->prepare(
            "INSERT INTO inscription (id_utilisateur, id_formation)
             VALUES (:id_utilisateur, :id_formation)"
        );
        $requete->execute([
            'id_utilisateur' => $idUtilisateur,
            'id_formation' => $idFormation
        ]);

        $requete = $bdd->prepare(
            "UPDATE formation
             SET inscrits = inscrits + 1
             WHERE id = :id"
        );
        $requete->execute(['id' => $idFormation]);

        $bdd->commit();
        return 'inscrit';
    } catch (PDOException $erreur) {
        $bdd->rollBack();
        throw $erreur;
    }
}

?>