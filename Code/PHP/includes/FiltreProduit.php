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
	if (isset($_GET['query'])) {
		try {
            // Appel de la procédure stockée ou exécution directe de la requête SQL
            $search = htmlentities($_GET['query']);
			
			// Base de la requête SQL
			$sql = "SELECT DF.IDPROD, NOMFORMAT, PRIX
				FROM DISPOFORMAT DF
				INNER JOIN FORMATPROD F ON F.IDFORMAT = DF.IDFORMAT
				INNER JOIN PRODUIT P ON P.IDPROD = DF.IDPROD
				WHERE (P.NOMPROD LIKE :search OR P.DESCRIPTION LIKE :search)";
				
			// Ajout de la condition de catégorie si sélectionnée
			if ($selectedCategory > 0) {
				$sql = $sql . " AND IDCATEG = :idCateg";
			}
			
			// Ajout de la condition de la fourchette de prix sélectionnée
			if (isset($_POST['inf10'])) {
				$sql .= " AND PRIX >= 0 AND PRIX < 10";
			}elseif (isset($_POST['10a20'])) {
				$sql .= " AND PRIX >= 10 AND PRIX <= 20";
			}elseif (isset($_POST['20a35'])) {
				$sql .= " AND PRIX >= 20 AND PRIX <= 35";
			}elseif (isset($_POST['35a50'])) {
				$sql .= " AND PRIX >= 35 AND PRIX <= 50";
			}elseif (isset($_POST['sup50'])) {
				$sql .= " AND PRIX > 50 AND PRIX <= 5000";
			}
			
			// Ajout de l'ordre de tri si spécifié
			if (isset($_POST['asc'])) {
				$sql .= " ORDER BY PRIX ASC";
			} elseif (isset($_POST['desc'])) {
				$sql .= " ORDER BY PRIX DESC";
			} else {
				$sql .= " ORDER BY IDPROD ASC";
			}
			
			$stmt = $conn->prepare($sql);
			
			// Liaison des paramètres
			$stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
			if ($selectedCategory > 0) {
				$stmt->bindValue(':idCateg', $selectedCategory, PDO::PARAM_INT);
			}
			$stmt->execute();

			$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();

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
