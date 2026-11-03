<?php
$motCle = trim($_GET['mot_cle'] ?? '');
$categorie = trim($_GET['categorie'] ?? '');
$date = trim($_GET['date'] ?? '');
$categories = recupererCategoriesFormations();
$formationsFiltrees = recupererFormations($motCle, $categorie, $date);

include 'vue/v_catalogue.php';