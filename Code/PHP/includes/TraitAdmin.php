<?php
require_once '../connect.inc.php';

// Vérifier que l'utilisateur est administrateur
if (!empty($_SESSION["loggedin"]) && isset($_SESSION['idPermission']) && $_SESSION['idPermission'] == 'Administrateur') {
    echo "<div class='alert alert-danger'>Accès refusé.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Suppression d'un produit
        if (isset($_POST['deleteProductID'])) {
            $deleteProductID = intval($_POST['deleteProductID']);
            $stmtDeleteIMG = $conn->prepare("DELETE FROM IMAGE WHERE IDPROD = ?");
            $stmtDeleteIMG->execute([$deleteProductID]);
            $stmtDeleteDCO = $conn->prepare("DELETE FROM DISPONIBLECOULEUR WHERE IDPROD = ?");
            $stmtDeleteDCO->execute([$deleteProductID]);
            $stmtDeleteDC = $conn->prepare("DELETE FROM DISPONIBLECONDITIONNEMENT WHERE IDPROD = ?");
            $stmtDeleteDC->execute([$deleteProductID]);
            $stmtDeleteDF = $conn->prepare("DELETE FROM DISPOFORMAT WHERE IDPROD = ?");
            $stmtDeleteDF->execute([$deleteProductID]);
            $stmtDeleteContient = $conn->prepare("DELETE FROM CONTIENT WHERE IDPROD = ?");
            $stmtDeleteContient->execute([$deleteProductID]);
            $stmtDeleteCom = $conn->prepare("DELETE FROM COMMENTAIRE WHERE IDPROD = ?");
            $stmtDeleteCom->execute([$deleteProductID]);
            $stmtDelete = $conn->prepare("DELETE FROM PRODUIT WHERE IDPROD = ?");
            $stmtDelete->execute([$deleteProductID]);

            if ($stmtDelete->rowCount() > 0) {
                echo "<div class='alert alert-success' role='alert'>Article supprimé avec succès !</div>";
                header('Location: ../produit.php');
            } else {
                echo "<div class='alert alert-danger'>Aucun produit trouvé avec cet ID.</div>";
            }
        }

        // Modification d'un produit
        if (isset($_POST['updateProductID'])) {
            $idProd = intval($_POST['updateProductID']);
            $newName = $_POST['newProductName'] ?? null;
            $newPrice = $_POST['newProductPrice'] ?? null;
            $newDescription = $_POST['newProductDescription'] ?? null;

            $query = "UPDATE PRODUIT SET ";
            $params = [];
            $updates = [];

            if ($newName) {
                $updates[] = "NOMPROD = ?";
                $params[] = $newName;
            }
            if ($newPrice) {
                $updates[] = "PRIX = ?";
                $params[] = $newPrice;
            }
            if ($newDescription) {
                $updates[] = "DESCRIPTION = ?";
                $params[] = $newDescription;
            }

            $query .= implode(', ', $updates) . " WHERE IDPROD = ?";
            $params[] = $idProd;

            $stmtUpdate = $conn->prepare($query);
            $stmtUpdate->execute($params);

            echo "<div class='alert alert-success'>Produit mis à jour avec succès.</div>";
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Requête non autorisée.</div>";
}
