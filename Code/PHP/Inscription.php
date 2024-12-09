<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Inclure uniquement une version de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel=" website icon" type="png" href="./images/logo/logo.png">
	<link rel="stylesheet" href="./includes/style.css">
	<title>Inscription | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php include './includes/header.php'; ?>

	<div class="container-fluid py-5 my-5">
		<div class="row py-5 mx-auto justify-content-evenly">
			<div class="col-md-6 col-sm-12 col-xs-12 my-5">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						INSCRIPTION
					</div>
					<div class="card-body">
						<form method="POST" action="./includes/TraitSignIn.php">
							<p>* Champs obligatoires</p>
							<div class="mb-3">
								<label for="nom" class="form-label">Nom *</label>
								<input placeholder="Entrez votre nom" name="nom" id="nom" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="prenom" class="form-label">Prénom *</label>
								<input placeholder="Entrez votre prénom" name="prenom" id="prenom" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">E-mail *</label>
								<input placeholder="Entrez votre e-mail" name="mail" id="email" class="form-control" type="email" required>
							</div>
							<div class="mb-3">
								<label for="password" class="form-label">Mot de passe *</label>
								<input placeholder="Entrez votre mot de passe" name="password" id="password" class="form-control" type="password" required>
							</div>
							<hr>
							<h5 class="text-danger mb-3">Adresse</h5>
							<div class="mb-3">
								<label for="numeroRue" class="form-label">N° de Rue *</label>
								<input placeholder="Entrez le numéro de la rue" name="numeroRue" id="numeroRue" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="nomRue" class="form-label">Nom de la Rue *</label>
								<input placeholder="Entrez le nom de la rue" name="nomRue" id="nomRue" class="form-control" type="text" required>
							</div>
							<div class="mb-3">
								<label for="pays" class="form-label">Pays *</label>
								<input placeholder="Entrez le pays" name="pays" id="pays" class="form-control" type="text" required>
							</div>
							<div>
								<button type="submit" name="submit" class="btn btn-primary">VALIDER</button>
							</div>
						</form>
					</div>
					<div class="card-footer text-muted">
						Vous avez un compte ? <a class="link" href="Connexion.php">Connectez-vous ici !</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include './includes/footer.php'; ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
