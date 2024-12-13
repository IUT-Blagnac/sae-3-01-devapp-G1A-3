<!DOCTYPE html>
<html lang="fr">

<?php
require_once 'includes/verif_inactivite.php';
?>

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
	<title>Modification | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
	<?php include_once './includes/header.php';
	include_once 'includes/verif_session.php'?>

	<div class="container-fluid py-2 my-2">
		<div class="row py-2 mx-auto justify-content-evenly">
			<div class="col-md-5 col-sm-12 col-xs-12 my-2">
				<div class="card text-center">
					<div class="card-header fw-bold text-danger">
						MODIFICATION
					</div>
					<div class="card-body">
						<form method="post" action="./includes/TraitModification.php">
							<div class="mb-3">
								<label class="sub_title" for="login">Identifiant de compte</label>
								<input name="idcompte" id="idcompte" class="form_style" type="text" value="<?php echo $_SESSION["idCompte"] ?>" readonly>
							</div>						
							<div class="mb-3">
								<label class="sub_title" for="login">Nom</label>
								<input name="nom" id="nom" class="form_style" type="text" value = <?php echo $_SESSION["nom"] ?> required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Prénom</label>
								<input name="prenom" id="prenom" class="form_style" type="text" value = <?php echo $_SESSION["prenom"] ?> required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Mail</label>
								<input name="mail" id="mail" class="form_style" type="email" value="<?php echo $_SESSION["mail"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Telephone</label>
								<input name="telephone" id="telephone" class="form_style" type="text" value="<?php echo $_SESSION["numeroTelephone"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Date de naissance</label>
								<input name="datenaissance" id="datenaissance" class="form_style" type="date" value="<?php echo $_SESSION["dateNaissance"] ?>" required>
							</div>
							<hr>
							<h5 class="text-danger mb-3">Adresse</h5>
							<div class="mb-3">
								<label class="sub_title" for="login">Identifiant d'adresse</label>
								<input name="idadresse" id="idadresse" class="form_style" type="text" value="<?php echo $_SESSION["idAdresse"] ?>" readonly>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Numéro de rue</label>
								<input name="numrue" id="numrue" class="form_style" type="text" value="<?php echo $_SESSION["numRue"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Nom de rue</label>
								<input name="nomrue" id="nomrue" class="form_style" type="text" value="<?php echo $_SESSION["nomRue"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Ville</label>
								<input name="ville" id="ville" class="form_style" type="text" value="<?php echo $_SESSION["ville"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Code Postal</label>
								<input name="codepostal" id="codepostal" class="form_style" type="text" value="<?php echo $_SESSION["codePostal"] ?>" required>
							</div>
							<div class="mb-3">
								<label class="sub_title" for="login">Pays</label>
								<input name="pays" id="pays" class="form_style" type="text" value="<?php echo $_SESSION["pays"] ?>" required>
							</div>
							<div>
								<input type="submit" name="submit" class="btn btn-primary" value="VALIDER">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include './includes/footer.php' ?>
</body>
</html>