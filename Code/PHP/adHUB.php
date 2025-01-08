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
    <title>AdminHUB - Gestion Produits</title>
    <style>
        body {
            background-color: #ffe4e1;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            color: #d0006f;
            margin: 2rem 0;
        }

        .container {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .nav-tabs .nav-link.active {
            background-color: #d0006f;
            color: #fff;
        }

        .form-label {
            font-weight: bold;
            color: #d0006f;
        }

        .btn-primary {
            background-color: #d0006f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #b0005e;
        }
    </style>
</head>

<body>
    <?php include './includes/header.php'; ?>

    <div class="container">
        <h1>Gestion de Produits</h1>

        <!-- Onglets pour les actions -->
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="add-product-tab" data-bs-toggle="tab" data-bs-target="#add-product" type="button" role="tab" aria-controls="add-product" aria-selected="true">Ajouter</button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="productTabsContent">
            <!-- Ajouter un produit -->
            <div class="tab-pane fade show active" id="add-product" role="tabpanel" aria-labelledby="add-product-tab">
                <form method="POST" action="./includes/TraitAdmin.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom du produit</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Prix</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Image du produit</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter le produit</button>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-HoA9HTiTR95gx12OJ0jZN2QFFqnPgucWn08H5WZbE1Rj3gqG/6M5DfdbNAvEd8CF" crossorigin="anonymous"></script>
</body>

</html>