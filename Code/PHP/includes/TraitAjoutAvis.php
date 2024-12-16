<?php
session_start();

if (isset($_POST['submit'])) {

    // Récupération des informations lors de l'inscription
    $AjouterAvis = htmlentities($_POST['AjouterAvis']);

    if (empty($AjouterAvis)) {
        die('Tous les champs sont obligatoires.');
    }

    // Connexion à la base de données
    require_once '../connect.inc.php';

    try {
        // Préparation de l'insertion des données
        $stmt = $conn->prepare('INSERT INTO COMMENTAIRE (CONTENU) VALUES (?)');
        $stmt->execute([$AjouterAvis]);

        $stmt = $conn->prepare('SELECT IDCOMTPE FROM COMMENTAIRE WHERE IDCOMMENTAIRE = ?');
        $stmt->execute([$AjouterAvis]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('INSERT INTO METHODEPAIEMENT (IDCOMPTE, IDOPTION, IDPAYPAL, STATUT) VALUES (?, 2, ?, ?)');
        $stmt->execute([$_SESSION["idCompte"], $result['IDPAYPAL'], 'Valide']);

        header('Location: ../profile.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
