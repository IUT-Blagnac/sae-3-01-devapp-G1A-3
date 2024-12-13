<?php
// Connexion à la base de données
include 'connect.inc.php';

// Récupération de la catégorie sélectionnée
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

// Récupération des produits de la catégorie sélectionnée et le prix avec la procédure stockée
$produits = [];
try {
    //Récupération des produits 
    if ($selectedCategory > 0) {
        $stmtProd = $conn->prepare(
            "SELECT IDPROD, NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
             FROM PRODUIT 
             WHERE IDCATEG = :idCateg"
        );
        $stmtProd->bindParam(':idCateg', $selectedCategory, PDO::PARAM_INT);
    } else {
        $stmtProd = $conn->prepare(
            "SELECT IDPROD, NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
             FROM PRODUIT"
        );
    }
    $stmtProd->execute();
    $produits = $stmtProd->fetchAll(PDO::FETCH_ASSOC);

    // Appel de la procédure stockée pour chaque produit 
    foreach ($produits as &$produit) {
        $stmtPrix = $conn->prepare("CALL get_dispos_produit_light(:IDPROD)");
        $stmtPrix->bindParam(':IDPROD', $produit['IDPROD'], PDO::PARAM_INT);

        $stmtPrix->execute();
        $dispo = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);

        // Ajouts les données retournées par la procédure au produit
        $produit['DISPO'] = $dispo;
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des produits : {$e->getMessage()}</div>";
    die();
}
