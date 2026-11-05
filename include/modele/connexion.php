<?php

$host = '127.0.0.1';
$db_name = 'leidoscope';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $bdd -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

?>