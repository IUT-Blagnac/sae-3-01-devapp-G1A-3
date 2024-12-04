<?php
//fonction permettant de générer un id unique
function generateId($prefix)
{
    $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT); // Génère un nombre à 6 chiffres
    return $prefix . $randomNumber; // Ajoute un préfixe (ex: 'CP', 'ADR')
}

if (isset($_POST('submit'))) {
    // Récupération des informations lors de l'inscription
    $nom = $_POST('nom');
    $prenom = $_POST('prenom');
    $mail = $_POST('mail');
    $psswd = $_POST('password');

    //connexion à la base de données
    require_once 'connect.inc.php';
    $sql = 'INSERT INTO COMPTE VALUES("","' . $nom . '","' . $prenom . '","' . $mail . '","' . $psswd . '")';
}
