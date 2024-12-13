<?php
session_start();

// Connexion à la base de données
require_once '../connect.inc.php';

$quantite =  $_POST['quantite'];
if (isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
}
	
try {
    // Préparation de l'insertion des données
    $stmt = $conn->prepare('CALL get_panier(?)');
    $stmt->execute([$_SESSION['idCompte']]);
    $panier = $stmt->fetch(PDO::FETCH_ASSOC);

    $date = date('Y-m-d', time());


    if ($panier === false){
        $stmt = $conn->prepare('INSERT INTO COMMANDE (DATECOMMANDE, DATELIVR, IDADRESSE, IDCOMPTE, IDPAIEMENT, STATUSCOMMANDE) VALUES (?, NULL, ?, ?, NULL, "Panier")');
        $stmt->execute([$date, $_SESSION['idAdresse'], $_SESSION['idCompte']]);
        $_SESSION['panier'] = $panier;
    }

    $stmt = $conn->prepare('SELECT QTE FROM CONTIENT WHERE IDCOMMANDE = ? AND IDPROD = ?');
    $stmt->execute([$panier['IDCOMMANDE'], $idProduit]);
    $quantiteActuelle = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($quantiteActuelle)){
        $stmt = $conn->prepare('INSERT INTO CONTIENT (IDCOMMANDE, IDPROD, QTE) VALUES (?, ?, ?)');
        $stmt->execute([$panier['IDCOMMANDE'], $idProduit, $quantite]);
    }
    else{
        $stmt = $conn->prepare('UPDATE CONTIENT SET QTE = ? WHERE IDCOMMANDE = ? AND IDPROD = ?');
        $stmt->execute([$quantite, $panier['IDCOMMANDE'], $idProduit]);
    }

    if ($_POST['action'] == 'Ajouter au panier'){
        header('Location: ../detailProd.php?idProduit='.$idProduit);
        exit();
    }
    else{
        header('Location: ../shoppingCart.php');
        exit();
    }
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());    
}
?>