<?php
session_start();

include_once('../connect.inc.php');

try {
    $date = date('Y-m-d', time());
    
    $stmt = $conn->prepare('CALL get_panier(?)');
    $stmt->execute([$_SESSION['idCompte']]);
    $panier = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare('UPDATE COMMANDE SET STATUSCOMMANDE = ?, DATECOMMANDE = ? WHERE IDCOMMANDE = ?');
    $stmt->execute(['Payée', $date, $panier['IDCOMMANDE']]);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

    $stmt = $conn->prepare('INSERT INTO COMMANDE (DATECOMMANDE, DATELIVR, IDADRESSE, IDCOMPTE, IDPAIEMENT, STATUSCOMMANDE) VALUES (?, NULL, ?, ?, NULL, "Panier")');
    $stmt->execute([$date, $_SESSION['idAdresse'], $_SESSION['idCompte']]);
    $_SESSION['panier'] = $panier;

    header('Location: ../index.php');
?>