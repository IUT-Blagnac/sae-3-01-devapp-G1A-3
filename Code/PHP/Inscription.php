<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel=" website icon" type="png" href="./images/logo/logo.png">
	<link rel="stylesheet" href="style.css">
	<title>Inscription | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php include './includes/header.php' ?>

	<div class="container-fluid py-5 my-5">
		<div class="row py-5 mx-auto justify-content-evenly">
			<div class="col-md-5 col-sm-12 col-xs-12 my-5">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						INSCRIPTION
					</div>
					<div class="card-body">
						<form action="./includes/TraitSignIn.php">
							<p>* champs obligatoires</p>
							<div class="form_group">
								<label class="sub_title" for="nom">Nom *</label>
								<input placeholder="Entrez votre nom" name="nom" id="nom" class="form_style" type="text">
							</div><br>
							<div class="form_group">
								<label class="sub_title" for="email">Prénom *</label>
								<input placeholder="Entrez votre prénom" name="prenom" id="prenom" class="form_style" type="text">
							</div><br>
							<div class="form_group">
								<label class="sub_title" for="email">E-mail *</label>
								<input placeholder="Entrez votre e-mail" name="mail" id="email" class="form_style" type="email">
							</div><br>
							<div class="form_group">
								<label class="sub_title" for="password">Mot de passe *</label>
								<input placeholder="Entrez votre mot de passe" name="password" id="password" class="form_style" type="password">
							</div><br>
							<div>
								<button class="btn btn-primary" name="submit">VALIDER</button>
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

	<?php
	//   require_once('connect.inc.php');
	//   $result = $conn -> prepare ("INSERT INTO Compte VALUES (?,?,?)");
	//   $result -> execute(array(htmlentities($_POST["nom"]), htmlentities($_POST["prenom"]), htmlentities($_POST["email"])));
	//   $result = $conn -> prepare ("INSERT INTO MotDePasse VALUES (?)");
	//   $result -> execute(array(htmlentities( CHIFFRER LE MOTDEPASSE $_POST["password"])));
	?>

	<?php include './includes/footer.php' ?>

</body>

</html>