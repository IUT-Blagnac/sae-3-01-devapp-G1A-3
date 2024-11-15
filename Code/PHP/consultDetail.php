<?php require_once("./include/verif_session.php")?>

<!-- partie html & head -->
<?php require_once("./include/head.php"); ?>

<!-- partie body -->
<?php require_once("./include/header.php"); ?>

<head>
	<!-- Ce code Javascript doit etre inclus dans head.php, dans la balise <head> -->
		<script>
			// Cette fonction permettra de demander confirmation avant la suppression d'un produit
			function confirmSuppr(idProd) {
				if(confirm("Etes vous sur de  vouloir supprimer ce produit ?")){
					document.location.href = "index.php";
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
        <?php require_once("./include/menu.php"); ?>

        <!-- partie contenu principal -->
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <?php
                require_once('connect.inc.php');
                if(isset($_GET['idProduit'])){
                    $result = $conn -> prepare ("SELECT * FROM Produits WHERE idProduit = ?");
                    $result -> execute(array($_GET['idProduit']));
                    echo "<BR/><BR/><center><table border='2'>";
                    echo "<tr><th>Identifiant du produit</th><th>Identifiant de la categorie du produit</th><th>Nom du produit</th><th>Prix du produit</th><th>Image du produit</th><th>Modifier</th><th>Supprimer</th></tr>";	
                    foreach($result as $produit) {
                        echo "<tr>";
                        echo "<td><a href=\"http://193.54.227.208/~R2024PHP2009/PHP/SAE/consultDetail.php?idProduit=".$produit['idProduit']."\">".$produit['idProduit']."</td>";
                        echo "<td>".$produit['idCategorie']."</td>";
                        echo "<td>".$produit['nomProduit']."</td>";
                        echo "<td>".$produit['prixProduit']."</td>";
                        echo "<td><img src=\"./images/prod".$produit['idProduit'].".jpg\" width=30% alt=\"Img du bien\" /></td>";
                        echo "<td><a href =\"http://193.54.227.208/~R2024PHP2009/PHP/SAE/ModifProd.php?idProduit=".$produit['idProduit']."\">
                          <img src=\"./images/modifier.jpg\" width=30% alt=\"Img du bien\" />
                         </a></td>";
                  			echo "<td>  <a href='javascript:confirmSuppr(".$produit['idProduit'].")'>
								          <img src='./images/supprimer.jpg' width=40% alt='Supprimer' />
		                    </a></td>";
                        echo "</tr>";	
                    }
                    echo "</table></center>";
                }
            ?>
		</main>
	</div>
</div>

<!-- Pied de page & fin html -->
<?php require_once("./include/footer.php"); ?>