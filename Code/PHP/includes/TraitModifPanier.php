<?php
session_start();

// Connexion à la base de données
require_once '../connect.inc.php';

if (!empty($_POST)){
    if (isset($_SESSION['idCompte'])){
        if (gettype($_SESSION['idCompte']) === "integer"){
            try {
                $stmt = $conn->prepare('UPDATE CONTIENT SET QTE = ? WHERE IDCOMMANDE = ? AND IDPROD = ?');
                $stmt->execute([$_POST['quantity'], $_POST['command_id'], $_POST['product_id']]);
                 
                echo "Changement effectué";
        
                header("Location: ../shoppingCart.php");
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
    else{
        foreach($_COOKIE["panierInvite"] as $name => $value){
            $data = unserialize($value);
            if ($data['idProduit'] == $_POST['product_id']){
                var_dump($data);
                $data['qteProduit'] = $_POST['quantity'];
                var_dump($data);
                $serializedData = serialize($data);
                setcookie('panierInvite['.$name.']', $serializedData, time()+3600 * 24 * 31, "/");
            }
        }
        header("Location: ../shoppingCart.php");
    }
}
?>