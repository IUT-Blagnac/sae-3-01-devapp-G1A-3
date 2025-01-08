<?php
session_start();

// Connexion à la base de données
require_once '../connect.inc.php';

$idProduit = $_POST['idProduit'];
$quantite =  $_POST['quantite'];
$format = $_POST['selected-format'];
$idformatreq = $conn -> prepare('SELECT IDFORMAT FROM FORMATPROD WHERE NOMFORMAT = ?');
$idformatreq -> execute([$format]);
$idformat = $idformatreq -> fetch()["IDFORMAT"];

var_dump($quantite);

if (isset($_SESSION['idCompte'])){
    if (gettype($_SESSION['idCompte']) === "integer"){
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
                $stmt = $conn->prepare('INSERT INTO CONTIENT (IDCOMMANDE, IDPROD, IDFORMAT, QTE) VALUES (?, ?, ?, ?)');
                $stmt->execute([$panier['IDCOMMANDE'], $idProduit, $idformat, $quantite]);
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
    }
}
else{
    if (empty($_COOKIE['panierInvite'])){
        $data = [
            'idProduit' => $idProduit,
            'qteProduit' => $quantite,
            'formatProduit' => $format
        ];
    
        $serializedData = serialize($data);
    
        setcookie('panierInvite[0]', $serializedData, time()+3600 * 24 * 31, "/");
    }
    else{
        $nbVal = count($_COOKIE['panierInvite']);

        foreach($_COOKIE["panierInvite"] as $name => $value){
            $data = unserialize($value);

            if ($idProduit == $data['idProduit']){
                $ajoute = true;
            }
        }
        if ($ajoute == false){
            $data = [
                'idProduit' => $idProduit,
                'qteProduit' => $quantite,
                'formatProduit' => $format
            ];
    
            $serializedData = serialize($data);
    
            setcookie('panierInvite['.$nbVal.']', $serializedData, time()+3600 * 24 * 31, "/");
        }
    }
    if ($_POST['action'] == 'Ajouter au panier'){
        header('Location: ../detailProd.php?idProduit='.$idProduit);
        exit();
    }
    else{
        header('Location: ../shoppingCart.php');
        exit();
    }
}

?>