<?php
session_start();
require_once('../connect.inc.php');

if (isset($_SESSION['idCompte'])){
    $result = $conn -> prepare ("DELETE FROM CONTIENT WHERE IDPROD = ? AND IDCOMMANDE = ?");
    $result->execute([htmlentities($_GET["idProduit"]), $_SESSION['panier']]);
}
else{
    foreach($_COOKIE["panierInvite"] as $name => $value){
        $data = unserialize($value);

        if ($_GET["idProduit"] == $data['idProduit']){
            unset($_COOKIE['panierInvite'.$name]);
        }
    }
}
header('Location: ../shoppingCart.php');
exit();
?>