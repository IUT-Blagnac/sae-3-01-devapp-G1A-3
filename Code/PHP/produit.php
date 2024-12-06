<?php
// Connexion à la base de données
include 'connect.inc.php';

// Récupérer la catégorie sélectionnée
$selectedCategory = isset($_POST['categorie']) ? intval($_POST['categorie']) : 0;

// Récupérer les catégories depuis la base de données
try {
    $stmtCat = $conn->prepare("SELECT IDCATEG, NOMCATEG FROM CATEGORIE");
    $stmtCat->execute();
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des catégories : {$e->getMessage()}</div>";
    die();
}

// Récupérer les produits de la catégorie sélectionnée
$produits = [];
if ($selectedCategory > 0) {
    try {
        $stmtProd = $conn->prepare(
            "SELECT IDPROD, NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
             FROM PRODUIT 
             WHERE IDCATEG = :idCateg"
        );
        $stmtProd->bindParam(':idCateg', $selectedCategory, PDO::PARAM_INT);
        $stmtProd->execute();
        $produits = $stmtProd->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur lors de la récupération des produits : {$e->getMessage()}</div>";
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="website icon" type="png" href="./images/logo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Nos Produits</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php include './includes/header.php'; ?>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Barre de Filtres -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" id="filtreProd">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100" id="filterMenu">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline" id="filtreTitle">Filtres</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <!-- Filtre par catégorie -->
                        <li class="nav-item">
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
                        </li>
                        <!-- Autres filtres (à personnaliser selon vos besoins) -->
                        <li>
                            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-money-bill"></i> <span class="ms-1 d-none d-sm-inline">Par Prix</span> 
                            </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                                <li><a href="#" class="nav-link px-0">Item 1</a></li>
                                <li><a href="#" class="nav-link px-0">Item 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Clients</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Affichage des Produits -->
            <div class="col py-3">
                <div class="row">
                    <?php if (!empty($produits)): ?>
                        <?php foreach ($produits as $produit): ?>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($produit['NOMPROD']) ?></h5>
                                        <p class="card-text">
                                            <strong>Composition :</strong> <?= htmlspecialchars($produit['COMPOSITION']) ?><br>
                                            <strong>Notes techniques :</strong> <?= htmlspecialchars($produit['NOTESTECH'] ?? 'Non spécifié') ?><br>
                                            <strong>Description :</strong> <?= htmlspecialchars($produit['DESCRIPTION'] ?? 'Aucune description disponible') ?>
                                        </p>
                                        <a href="#" class="btn btn-primary">Voir l'article</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="alert alert-info py-5 mx-3">Aucun produit disponible pour cette catégorie.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
