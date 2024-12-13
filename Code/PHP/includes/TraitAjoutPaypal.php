<?php
session_start();

if (isset($_POST['submit'])) {

    // Récupération des informations lors de l'inscription
    $mailPaypal = htmlentities($_POST['mailpaypal']);
    
	if (empty($mailPaypal)) {
        die('Tous les champs sont obligatoires.');
    }

    // Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        // Préparation de l'insertion des données
        $stmt = $conn->prepare('INSERT INTO PAYPAL (MAIL) VALUES (?)');
        $stmt->execute([$mailPaypal]);

        $stmt = $conn->prepare('SELECT IDPAYPAL FROM PAYPAL WHERE MAIL = ?');
        $stmt->execute([$mailPaypal]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('INSERT INTO METHODEPAIEMENT (IDCOMPTE, IDOPTION, IDPAYPAL, STATUT) VALUES (?, 2, ?, ?)');
        $stmt->execute([$_SESSION["idCompte"], $result['IDPAYPAL'], 'Valide']);
        
        header('Location: ../profile.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>