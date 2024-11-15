<?php require_once("./include/verif_session.php");
      require_once('connect.inc.php');
      $result = $conn -> prepare ("DELETE FROM Produits WHERE idProduit = ?");
      $result -> execute(array(htmlentities($_GET["idProduit"])));
?>