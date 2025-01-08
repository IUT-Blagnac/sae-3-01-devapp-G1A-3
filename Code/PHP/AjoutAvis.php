<!DOCTYPE html>
<html lang="fr">

<?php
require_once 'includes/verif_inactivite.php';
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Inclure uniquement une version de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel=" website icon" type="png" href="./images/logo/logo.png">
	<link rel="stylesheet" href="./includes/style.css">
	<title>Ajout Paypal | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php 
		include './includes/header.php'; 
		if (!empty($_GET)){
			$idProduit = htmlentities($_GET['idProduit']);
		}
	?>

	<div class="container-fluid py-5 my-5">
		<div class="row py-5 mx-auto justify-content-evenly">
			<div class="col-md-6 col-sm-12 col-xs-12 my-5">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						AVIS
					</div>
					<div class="card-body">
						<form method="POST" action="./includes/TraitAjoutAvis.php?idProduit=<?php echo $idProduit ?>">
							<div class="mb-3">
								<label for="mailpaypal" class="form-label">Note (comprise entre 1 et 10)</label>
								<input placeholder="10" name="note" id="note" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="mailpaypal" class="form-label">Commentaire</label>
								<input placeholder="J'adore ce produit !" name="avis" id="avis" class="form-control" type="text" required>
							</div>
                            <div>
								<button type="submit" name="submit" class="btn btn-primary">AJOUTER UN AVIS</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include './includes/footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
