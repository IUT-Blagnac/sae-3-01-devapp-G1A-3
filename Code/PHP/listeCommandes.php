<?php
require_once 'includes/verif_inactivite.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="icon" type="image/png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Mes Commandes | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php include './includes/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-center text-danger fw-bold">Mes Commandes</h1>
        <div class="row g-4">
            <?php
            require_once 'connect.inc.php';
            $listeCommandes = $conn->prepare('SELECT * FROM COMMANDE WHERE IDCOMPTE = ? ORDER BY DATECOMMANDE ASC');
            $listeCommandes->execute([$_SESSION['idCompte']]);

            foreach ($listeCommandes->fetchAll() as $commande) {
                echo '<div class="col-md-6 col-lg-4">';
                echo '<div class="card shadow-sm h-100">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title text-primary">Commande # ' . htmlspecialchars($commande["IDCOMMANDE"]) . '</h5>';
                echo '<p class="card-text">';

                if ($commande["STATUSCOMMANDE"] != "Panier") {
                    echo '<strong>Date :</strong> ' . htmlspecialchars($commande["DATECOMMANDE"]) . '<br>';
                } else {
                    echo '<strong>Panier créé le :</strong> ' . htmlspecialchars($commande["DATECOMMANDE"]) . '<br>';
                }

                echo '<strong>Statut :</strong> ' . htmlspecialchars($commande["STATUSCOMMANDE"]) . '<br>';

                $listeCommandes->closeCursor();
                $prixTotal = $conn->prepare('CALL get_prix_commande (?)');
                $prixTotal->execute([$commande["IDCOMMANDE"]]);
                $result = $prixTotal->fetch();

                if ($result) {
                    echo '<strong>Total :</strong> ' . htmlspecialchars($result["Prix"]) . ' €';
                } else {
                    echo '<strong>Total :</strong> Panier vide';
                }

                echo '</p>';
                echo '<a href="detailCommande.php?id_commande=' . htmlspecialchars($commande["IDCOMMANDE"]) . '" class="btn btn-danger w-100">Voir les Détails</a>';
                echo '</div>'; // Fin card-body
                echo '</div>'; // Fin card
                echo '</div>'; // Fin col
            }

            if ($listeCommandes->rowCount() === 0) {
                echo '<div class="col-12 text-center">';
                echo '<p class="text-muted">Vous n\'avez aucune commande pour le moment.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

</body>

</html>
