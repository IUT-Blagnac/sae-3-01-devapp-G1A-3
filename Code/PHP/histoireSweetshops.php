<!DOCTYPE html>
<html lang="fr">

<?php
require_once 'includes/verif_inactivite.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="website icon" type="png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Notre histoire | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php include './includes/header.php' ?>
	
	<div class="container">
        <div class="row">
            <h1 class="fw-bold text-danger">L'histoire de SweetShops</h1>
			<hr>
			<div class="container mt-5 position-relative">
				<div class="row align-items-center">
					<div class="col-md-3">
						<img src="./images/activite1.jpeg" class="img-fluid rounded custom-image">
					</div>
					<!-- Colonne pour le texte -->
					<div class="col-md-6 position-relative">
						<h2 class="fw-bold text-danger custom-text">
							Notre Activité
						</h2>
						<p>SweetShops est une entreprise spécialisée dans la vente de confiseries et<br>
						   chocolats haut de gamme. Nous proposons une large gamme de bonbons,<br>
						   chocolats, ainsi que des boissons telles que des sodas et des thés glacés.<br>
						   Nous mettons l’accent sur la qualité des ingrédients et l’originalité de nos<br>
						   recettes pour répondre aux attentes des amateurs de confiseries premium.
						</p>
					</div>
					<!-- Colonne pour l'image -->
					<div class="col-md-3">
						<img src="./images/activite2.jpeg" class="img-fluid rounded custom-image">
					</div>
				</div>
			</div>
			<div class="container mt-5 position-relative">
				<div class="row align-items-center">
					<!-- Colonne pour l'image -->
					<div class="col-md-6">
						<img src="./images/histoireSweetShops.webp" class="img-fluid rounded custom-image">
					</div>
					<!-- Colonne pour le texte -->
					<div class="col-md-6 position-relative">
						<h2 class="fw-bold text-danger custom-text">
							Notre histoire
						</h2>
						<p>Fondée en 2015 par Alexandre Dupont à Toulouse, SweetShops est née de la passion<br>
						   de son fondateur pour les confiseries découvertes lors de ses voyages en Europe.<br>
						   Constatant un manque de produits de qualité sur le marché français, il a décidé de créer<br>
						   une enseigne offrant des produits diversifiés et premium. Depuis sa création, SweetShops<br>
						   s’est imposée comme une référence sur le marché des confiseries haut de gamme,<br>
						   développant une clientèle fidèle.
						</p>
					</div>
				</div>
			</div>
			<div class="container mt-5 position-relative">
				<div class="row align-items-center">
					<!-- Colonne pour le texte -->
					<div class="col-md-6 position-relative">
						<h2 class="fw-bold text-danger custom-text">
							Notre dirigeant
						</h2>
						<p>Alexandre Dupont, fondateur et dirigeant de SweetShops, possède une expérience solide<br>
						   dans le secteur de la distribution. Sa passion pour les confiseries et son engagement envers<br>
						   l’innovation ont permis à l’entreprise de connaître une croissance soutenue, avec<br>
						   l’ouverture de plusieurs boutiques en France, notamment à Lyon, Bordeaux et Marseille.
						</p>
					</div>
					<!-- Colonne pour l'image -->
					<div class="col-md-6">
						<img src="./images/fondateurSweetShops.jpg" class="img-fluid rounded custom-image">
					</div>
				</div>
			</div>
        </div>
    </div>
	
	<?php include './includes/footer.php' ?>
	
</body>

</html>