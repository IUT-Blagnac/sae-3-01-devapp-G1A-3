<?php
require_once 'includes/verif_inactivite.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="website icon" type="png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Ma commande | SweetShops</title>
</head>

<body>
    <?php
		if(isset($_GET["id_commande"])){
			$safeIdCommande=htmlentities($_GET["id_commande"]);
			require_once 'connect.inc.php';
			$detailsCommande = $conn -> prepare('CALL get_commande_details(?)');
			$detailsProduit = $conn -> prepare('CALL get_details_produit(?,?)');
			$detailsCommande -> execute([$safeIdCommande]);
			foreach($detailsCommande -> fetchAll() as $produit){
				echo '<div>';
				echo '<span>';
				echo '<a href = "detailProd.php?idProduit='.$produit["IDPROD"].'">'.$produit["NOMPROD"].'</a>  ';
				echo '</span>';
				$detailsCommande -> closeCursor();
				$detailsProduit -> execute ([$produit["IDPROD"],$produit["IDFORMAT"]]);
				$prodComplements = $detailsProduit -> fetch();
				echo '<span>';
				echo 'Prix unitiaire : '.$prodComplements["PRIX"].'   Prix total : '.$prodComplements["PRIX"]*$produit["QTE"].'<BR/>';
				echo 'Quantité : '.$produit["QTE"];
				echo '</span>';
				echo '</div>';
			}
		}
	?>
</body>

</html>