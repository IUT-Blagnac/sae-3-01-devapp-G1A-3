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
	$stmtCat->closeCursor();
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
	$stmtProd->closeCursor();

    // Appel de la procédure stockée pour chaque produit 
    foreach ($produits as &$produit) {
        $stmtPrix = $conn->prepare("CALL get_dispos_produit_light(:IDPROD)");
        $stmtPrix->bindParam(':IDPROD', $produit['IDPROD'], PDO::PARAM_INT);

        $stmtPrix->execute();
        $dispo = $stmtPrix->fetch(PDO::FETCH_ASSOC);
		$stmtPrix->closeCursor();

        // Ajouts les données retournées par la procédure au produit
        $produit['DISPO'] = $dispo;
    }

    if(isset($_POST['inf10'])){
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix->execute([0,10]);
        $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();

        foreach ($produits as &$produit) {
            $stmtProd = $conn->prepare(
                "SELECT NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
                FROM PRODUIT 
                WHERE IDPROD = ?"
            );

            $stmtProd->execute([$produit['IDPROD']]);
            $carac = $stmtProd->fetch(PDO::FETCH_ASSOC);
            $stmtProd->closeCursor();

            $produit['CARAC'] = $carac;
        }

        var_dump($produits);
    }
    if(isset($_POST['10a20'])){
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix->execute([10,20]);
        $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
    if(isset($_POST['20a35'])){
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix->execute([20,35]);
        $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
    if(isset($_POST['35a50'])){
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix->execute([35,50]);
        $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
    if(isset($_POST['sup50'])){
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix->execute([50,5000]);
        $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
    if (isset($_POST['asc'])) {
        $stmtPrix = $conn ->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix ->execute([0,5000]);
        $stmtPrix ->setFetchMode(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
    if (isset($_POST['desc'])) {
        $stmtPrix = $conn ->prepare('CALL get_dispos_produit_borne(?, ?)');
        $stmtPrix ->execute([5000,0]);
        $stmtPrix ->setFetchMode(PDO::FETCH_ASSOC);
        $stmtPrix->closeCursor();
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des produits : {$e->getMessage()}</div>";
    die();
}
