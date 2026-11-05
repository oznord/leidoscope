<?php
$idFormation = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$formation = $idFormation ? recupererFormation($idFormation) : null;
$message = null;

if ($formation !== null && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultat = inscrireSalarie((int) $_SESSION['utilisateur_id'], $idFormation);

    if ($resultat === 'inscrit') {
        $message = 'Vous êtes inscrit à cette formation.';
        $formation = recupererFormation($idFormation);
    } elseif ($resultat === 'complet') {
        $message = 'Cette formation est complète.';
    } elseif ($resultat === 'conflit') {
        $message = 'Vous avez déjà une formation sur ce créneau.';
    }
}

$formationComplete = $formation === null
    || (int) $formation['inscrits'] >= (int) $formation['places'];
$creneauOccupe = $formation !== null
    && salarieADejaUnCreneau((int) $_SESSION['utilisateur_id'], $idFormation);

include 'vue/v_formation.php';
