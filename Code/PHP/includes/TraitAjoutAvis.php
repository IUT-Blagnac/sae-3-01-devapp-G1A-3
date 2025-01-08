<?php
session_start();

if (isset($_POST['submit'])) {

    // Récupération des informations lors de l'inscription
    $idProduit = htmlentities($_GET['idProduit']);
    $avis = htmlentities($_POST['avis']);
    $note = htmlentities($_POST['note']);

    var_dump($idProduit);
    var_dump($avis);
    var_dump($note);
    var_dump($_SESSION['idCompte']);

    if (empty($avis)) {
        header('Location: ../AjoutAvis.php');
        exit;
    }

    // Connexion à la base de données
    require_once '../connect.inc.php';

    try {
        // Préparation de l'insertion des données
        $stmt = $conn->prepare('INSERT INTO COMMENTAIRE (CONTENU, IDCOMPTE, IDPROD, NBETOILE) VALUES (?, ?, ?, ?)');
        $stmt->execute([$avis, $_SESSION['idCompte'], $idProduit, $note]);

        header('Location: ../detailProd.php?idProduit='.$idProduit);
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
