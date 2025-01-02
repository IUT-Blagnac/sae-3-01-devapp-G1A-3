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

        $produit = array_merge($produit, $dispo);
    }
    //produit inférieur à 10
    if (isset($_POST['inf10'])) {
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne_min(?, ?)');
        $stmtPrix->execute([0, 10]);
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

            $produit = array_merge($produit, $carac);
        }
    }
    // produit entrte dans la plage 10-20
    if (isset($_POST['10a20'])) {
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne_min(?, ?)');
        $stmtPrix->execute([10, 20]);
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

            $produit = array_merge($produit, $carac);
        }
    }
    // produit entrte dans la plage 20-35
    if (isset($_POST['20a35'])) {
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne_min(?, ?)');
        $stmtPrix->execute([20, 35]);
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

            $produit = array_merge($produit, $carac);
        }
    }
    // produit entrte dans la plage 35-50
    if (isset($_POST['35a50'])) {
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne_min(?, ?)');
        $stmtPrix->execute([35, 50]);
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

            $produit = array_merge($produit, $carac);
        }
    }
    // produit supérieur à 50
    if (isset($_POST['sup50'])) {
        $stmtPrix = $conn->prepare('CALL get_dispos_produit_borne_min(?, ?)');
        $stmtPrix->execute([50, 5000]);
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

            $produit = array_merge($produit, $carac);
        }
    }
    // Tri par ordre croissant 
    if (isset($_POST['asc'])) {
        try {
            // Appel de la procédure stockée ou exécution directe de la requête SQL
            $stmtPrix = $conn->prepare("  
            SELECT DF.IDPROD, NOMFORMAT, PRIX 
            FROM DISPOFORMAT DF 
            INNER JOIN FORMATPROD F ON F.IDFORMAT = DF.IDFORMAT
            ORDER BY DF.IDPROD ASC, PRIX ASC
        ");
            $stmtPrix->execute();

            // Récupération des résultats
            $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC);
            $stmtPrix->closeCursor();

            // Ajout les détails pour chaque produit
            foreach ($produits as &$produit) {
                $stmtProd = $conn->prepare("
                SELECT NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
                FROM PRODUIT 
                WHERE IDPROD = :idProd
            ");
                $stmtProd->bindParam(':idProd', $produit['IDPROD'], PDO::PARAM_INT);
                $stmtProd->execute();
                $details = $stmtProd->fetch(PDO::FETCH_ASSOC);
                $stmtProd->closeCursor();

                // Fusion les informations dans le tableau final
                $produit = array_merge($produit, $details);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits (tri croissant) : " . $e->getMessage();
        }
    }


    // Tri par ordre décroissant
    if (isset($_POST['desc'])) {
        try {
            // Appel de la procédure stockée pour le tri décroissant
            $stmtPrix = $conn->prepare('CALL get_dispos_produit_light_desc(?)');
            $stmtPrix->bindParam(1, $_POST['produit_id'], PDO::PARAM_INT); // Passage du paramètre produit_id
            $stmtPrix->execute();

            $produits = $stmtPrix->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats
            $stmtPrix->closeCursor();

            foreach ($produits as &$produit) {
                // Récupération des détails pour chaque produit
                $stmtProd = $conn->prepare(
                    "SELECT NOMPROD, COMPOSITION, NOTESTECH, DESCRIPTION 
                 FROM PRODUIT 
                 WHERE IDPROD = :idProd"
                );
                $stmtProd->bindParam(':idProd', $produit['IDPROD'], PDO::PARAM_INT);
                $stmtProd->execute();
                $details = $stmtProd->fetch(PDO::FETCH_ASSOC);
                $stmtProd->closeCursor();

                // Ajout des détails au tableau produit
                $produit = array_merge($produit, $details);
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des produits : " . $e->getMessage();
        }
    }
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des produits : {$e->getMessage()}</div>";
    die();
}
