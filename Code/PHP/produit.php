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
    <link rel="icon" type="image/png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Nos Produits | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php include './includes/header.php';
    include './includes/FiltreProduit.php'; ?>

    <div class="container-fluid">
        <!-- Navigation supérieure -->
        <ul class="nav justify-content-center custom-nav mb-4">
            <li class="nav-item">
                <a class="nav-link fw-bold text-danger active" href="#">PROMOTIONS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold text-danger" href="#">NOËL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold text-danger" href="#">NOS STARS</a>
            </li>
        </ul>

        <div class="row">
            <!-- Barre de filtres -->
            <div class="col-12 col-md-3 mb-4">
                <div class="bg-white p-3 rounded shadow-sm">
                    <h5 class="text-center">Filtres</h5>
                    <hr>
                    <form method="POST">
                        <select name="categorie" class="form-select mb-3" onchange="this.form.submit()">
                            <option value="0" <?= $selectedCategory === 0 ? 'selected' : '' ?>>Toutes les catégories</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['IDCATEG'] ?>" <?= $selectedCategory === $category['IDCATEG'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['NOMCATEG']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                    <hr>
                    <h5 class="text-center">Prix</h5>
                </div>
            </div>

            <!-- Affichage des produits -->
            <div class="col-12 col-md-9">
                <div class="row g-4">
                    <?php if (!empty($produits)){
                            foreach ($produits as &$produit){
                                echo "<div class='col-12 col-sm-6 col-lg-4'>
                                    <div class='card h-100'>
                                        <div class='card-body'>
                                            <h5 class='card-title text-truncate'>".htmlspecialchars($produit['NOMPROD'])."</h5>
                                            <p class='card-text'>
                                                <img src='images/produits/image".htmlspecialchars($produit['IDPROD']).".jpeg' width='100%'>
                                                <strong>Composition :</strong>".htmlspecialchars($produit['COMPOSITION'])."<br>
                                                <strong>Notes techniques :</strong>".htmlspecialchars($produit['NOTESTECH'] ?? 'Non spécifié')."<br>
                                                <strong>Description :</strong>".htmlspecialchars($produit['DESCRIPTION'] ?? 'Aucune description disponible')."
                                                <br>
                                                <strong>".htmlspecialchars($produit['DISPO'][0]['PRIX'])." €</strong>
                                            </p>
                                            <a href='detailProd.php?idProduit=".htmlspecialchars($produit['IDPROD'])."' class='btn btn-primary'>Voir l'article</a>
                                        </div>
                                    </div>
                                </div>";
                            }
                        }
                        else{
                            echo "<p class='text-center'>Aucun produit trouvé.</p>";
                        } ?>
                </div>
            </div>
        </div>
    </div>
    

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>