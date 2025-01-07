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

<body style="background-color: #ffe4e1;">
	<?php include './includes/header.php' ?>

	<?php
	if (isset($_GET["id_commande"])) {
		$prixTotalCommande = 0;
		$safeIdCommande = htmlentities($_GET["id_commande"]);
		require_once 'connect.inc.php';
		$detailsCommande = $conn->prepare('CALL get_commande_details(?)');
		$detailsProduit = $conn->prepare('CALL get_details_produit(?,?)');
		$detailsCommande->execute([$safeIdCommande]);
	?>
		<div class="container my-5">
			<h1 class="text-center text-danger fw-bolder mb-4">Détails de votre commande</h1>
			<div class="row gy-4">
				<?php
				foreach ($detailsCommande->fetchAll() as $produit) {
					$detailsCommande->closeCursor();
					$detailsProduit->execute([$produit["IDPROD"], $produit["IDFORMAT"]]);
					$prodComplements = $detailsProduit->fetch();
				?>
					<div class="col-lg-4 col-md-6">
						<div class="card shadow-sm">
							<img src="images/produits/image<?= htmlspecialchars($produit["IDPROD"]) ?>.jpeg" class="card-img-top" alt="Product Image" style="max-height: 200px; object-fit: cover;">
							<div class="card-body d-flex flex-column align-items-center">
								<h5 class="card-title"><?= htmlspecialchars($produit["NOMPROD"]) ?></h5>
								<p class="card-text">
									<strong>Prix unitaire :</strong> <?= $prodComplements["PRIX"] ?> €<br>
									<strong>Quantité :</strong> <?= $produit["QTE"] ?><br>
									<strong>Prix total :</strong> <?= $prodComplements["PRIX"] * $produit["QTE"] ?> €
								</p>
								<a href="detailProd.php?idProduit=<?= $produit["IDPROD"] ?>" class="btn btn-p-cmd">Voir le produit</a>
							</div>
						</div>
					</div>
				<?php
					$prixTotalCommande += $prodComplements["PRIX"] * $produit["QTE"];
				}
				?>
			</div>
			<div class="text-center my-4">
				<h3 class="fw-bold text-primary">Prix total de la commande : <?= $prixTotalCommande ?> €</h3>
			</div>
		</div>
	<?php
	} else {
	?>
		<div class="container text-center my-5">
			<h1 class="text-danger">Aucune commande trouvée</h1>
			<p>Veuillez vérifier l'identifiant de la commande.</p>
			<a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
		</div>
	<?php
	}
	?>
</body>

</html>