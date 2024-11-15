<?php require_once("../include/verif_session.php")?>

<!-- partie html & head -->
<?php require_once("../include/head.php"); ?>

<!-- partie body -->
<?php require_once("../include/header.php"); ?>

<head>
	<!-- Ce code Javascript doit etre inclus dans head.php, dans la balise <head> -->
		<script>
			// Cette fonction permettra de demander confirmation avant la suppression d'un produit
			function confirmSuppr(idProd) {
				if(confirm("Etes vous sur de  vouloir supprimer ce produit ?")){
					document.location.href = "../index.php";
				} else {
					alert("Suppression annulée");
					return false;
				}
			}
		</script>
</head>

<!-- Conteneur principal -->
<div class="container-fluid flex-grow-1">
    <div class="row">

        <!-- partie menu -->
        <?php require_once("../include/menu.php"); ?>
        <?php
        require_once('../connect.inc.php');
        $result = $conn -> prepare ("SELECT nomProduit, prixProduit, idProduit FROM Produits");
        $result -> execute();
                foreach($result as $produit) {
        			echo "<tr>";
              echo "<td><a href=\"http://193.54.227.208/~R2024PHP2009/PHP/SAE/consultDetail.php?idProduit=".$produit['idProduit']."\"><img src=\"../images/prod".$produit['idProduit'].".jpg\" alt=\"Image manquante\" /></a></td>";
        			echo "<td>".$produit['nomProduit']."</td>";
        			echo "<td>".$produit['prixProduit']."€</td>";
        			echo "</tr>";
        		}
        		echo "</table></center><BR/><BR/>";
        ?>