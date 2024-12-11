<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Inclure uniquement une version de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel=" website icon" type="png" href="./images/logo/logo.png">
	<link rel="stylesheet" href="./includes/style.css">
	<title>AjoutCB | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php include './includes/header.php'; ?>

	<div class="container-fluid py-5 my-5">
		<div class="row py-5 mx-auto justify-content-evenly">
			<div class="col-md-6 col-sm-12 col-xs-12 my-5">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						AJOUT CARTE BANCAIRE
					</div>
					<div class="card-body">
						<form method="POST" action="./includes/TraitAjoutCB.php">
							<div class="mb-3">
								<label for="nom_carte" class="form-label">Nom sur la carte</label>
								<input placeholder="John Doe" name="nomCB" id="nomCB" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="numero_carte" class="form-label">Numéro de carte</label>
								<input placeholder="5500XXXXXXXXXXXX" name="numeroCB" id="numeroCB" class="form-control" type="text" required pattern="\d{16}" required>
							</div>
							<div class="mb-3">
								<label for="expiration" class="form-label">Date d'expiration (MM/AA)</label>
								<input placeholder="XX/XX" name="expiration" id="expiration" class="form-control" type="text" required pattern="(0[1-9]|1[0-2])/\d{2}" required>
							</div>
                            <div class="mb-3">
								<label for="cvv" class="form-label">CODE CVV (à 3 chiffres)</label>
								<input placeholder="XXX" name="cvv" id="cvv" class="form-control" type="text" required pattern="\d{3}" required>
							</div>
                            <div>
								<button type="submit" name="submit" class="btn btn-primary">VALIDER</button>
							</div>
						</form>
					</div>
					<div class="card-footer text-muted">
					<a class="link" href="AjoutPaypal.php">Ajouter un Paypal</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include './includes/footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
