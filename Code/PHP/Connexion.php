<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="website icon" type="png" href="./images/logo/logo.png">
	<link rel="stylesheet" href="./includes/style.css">
	<title>Connexion | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php include './includes/header.php' ?>

	<div class="container-fluid py-5 my-5">
		<div class="row py-5 mx-auto justify-content-evenly">
			<div class="col-md-5 col-sm-12 col-xs-12 my-5">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						CONNEXION
					</div>
					<div class="card-body">
						<form method="post" action="./includes/TraitConnexion.php">
							<p>* champs obligatoires</p>
							<div class="mb-3">
								<label class="sub_title" for="login">E-mail *</label>
								<input placeholder="Entrez votre e-mail" name="user_login" id="login" class="form_style" type="email" value="">
							</div>
							<div class="mb-3">
								<label class="sub_title" for="password">Mot de passe *</label>
								<input placeholder="Entrez votre mot de passe" name="user_password" id="password" class="form_style" type="password">
							</div>
							<div class="mb-3">
								<label class="sub_title" for="password">Se souvenir de moi</label>
								<input type="checkbox" name="seSouvenirMoi">
							</div>
							<div>
								<input type="submit" name="envoyer" class="btn btn-primary" value="VALIDER">
							</div>
						</form>
					</div>
					<div class="card-footer text-muted">
						Vous souhaitez créer un compte ? <a class="link" href="Inscription.php">Inscrivez-vous ici !</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include './includes/footer.php' ?>

</body>

</html>