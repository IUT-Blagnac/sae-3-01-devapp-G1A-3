<?php
session_start();
require_once 'connect.inc.php';

// Vérifier que l'utilisateur est administrateur
if ($_SESSION['idPermission'] !== 'Administrateur') {
    echo "<div class='alert alert-danger'>Accès refusé.</div>";
    exit();
}

// Récupération des données du produit
$product = null;
if (isset($_GET['idProduit']) && is_numeric($_GET['idProduit'])) {
    $idProduit = intval($_GET['idProduit']);

    try {
        $stmt = $conn->prepare("SELECT * FROM PRODUIT WHERE IDPROD = ?");
        $stmt->execute([$idProduit]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "<div class='alert alert-danger'>Produit introuvable.</div>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID produit manquant ou invalide.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modifier Produit</title>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">Modifier le produit</h1>

        <form method="POST" action="TraitAdmin.php">
            <input type="hidden" name="updateProductID" value="<?= htmlspecialchars($product['IDPROD']) ?>">

            <div class="mb-3">
                <label for="newProductName" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="newProductName" name="newProductName" value="<?= htmlspecialchars($product['NOMPROD']) ?>">
            </div>

            <div class="mb-3">
                <label for="newProductPrice" class="form-label">Prix</label>
                <input type="number" class="form-control" id="newProductPrice" name="newProductPrice" step="0.01" value="<?= htmlspecialchars($product['PRIX']) ?>">
            </div>

            <div class="mb-3">
                <label for="newProductDescription" class="form-label">Description</label>
                <textarea class="form-control" id="newProductDescription" name="newProductDescription" rows="4"><?= htmlspecialchars($product['DESCRIPTION']) ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="adminHub.php" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
