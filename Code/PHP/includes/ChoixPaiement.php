<?php
session_start();

include_once('../connect.inc.php');

if (isset($_POST['cb'])){
    $paiement = 1;
}
else if (isset($_POST['paypal'])){
    $paiement = 2;
}
else{
    header('Location: ../shoppingCart.php?paiement=true');
}

try {
    $stmt = $conn->prepare('CALL get_panier(?)');
    $stmt->execute([$_SESSION['idCompte']]);
    $panier = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare('UPDATE COMMANDE SET IDPAIEMENT = ? WHERE IDCOMMANDE = ?');
    $stmt->execute([$paiement, $panier['IDCOMMANDE']]);
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
    header('Location: ../shoppingCart.php?paiement=true');
?>