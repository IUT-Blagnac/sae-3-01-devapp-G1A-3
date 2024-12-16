<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Détails du Produit | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php
    include 'includes/header.php';
    require_once 'includes/verif_inactivite.php';
    require_once 'connect.inc.php';
    ?>

    <div class="container my-5">
        <div class="row">
            <!-- Section Image -->
            <div class="col-md-6 text-center product-image" id="product-img">
                <div class="cadre-image">
                    <?php $idProduit = (int)$_GET['idProduit']; echo "<img src='images/produits/image" . htmlspecialchars($idProduit) . ".jpeg' width='100%'>" ?>
                </div>
            </div>

            <!-- Détails du Produit -->
            <div class="col-md-6">
                <div class="mb-3 product-details" id="product-detail">
                    <?php
                    if (isset($_GET['idProduit']) && is_numeric($_GET['idProduit'])) {
                        $idProduit = (int)$_GET['idProduit']; // Cast sécurisé en entier
                        try {
                            // Requête produit
                            $stmt = $conn->prepare("SELECT * FROM PRODUIT WHERE IDPROD = ?");
                            $stmt->execute([$idProduit]);
                            $produit = $stmt->fetch(PDO::FETCH_ASSOC);

                            if (!$produit) {
                                echo "<p class='text-danger'>Aucun produit trouvé pour cet ID.</p>";
                                exit();
                            }

                            // Affichage des données produit
                            echo "<h2 class='textProduit'>" . htmlspecialchars($produit['NOMPROD']) . "</h2>";

                            // Requête moyenne des avis
                            $stmt = $conn->prepare('CALL get_moyenne_prod(?)');
                            $stmt->execute([$idProduit]);
                            $moyenneNotes = $stmt->fetch(PDO::FETCH_ASSOC);

                            // Affichage des étoiles
                            echo "<div class='star-rating'>";
                            if ($moyenneNotes !== false) {
                                $moyenneNotes = round($moyenneNotes['noteAvg'], 0, PHP_ROUND_HALF_DOWN);
                                for ($i = 0; $i < $moyenneNotes - 1; $i += 2) {
                                    echo "<img src='images/etoile_pleine.png' width='20' height='20'></img>";
                                }
                                if ($moyenneNotes - $i == 1) {
                                    echo "<img src='images/demi_etoile.png' width='20' height='20'></img>";
                                    $i += 2;
                                }
                                for ($i; $i < 10; $i += 2) {
                                    echo "<img src='images/etoile_vide.png' width='20' height='20'></img>";
                                }
                            } else {
                                echo "Aucun avis sur ce produit";
                            }
                            echo "</div>";

                            echo "<p><strong>Notes Techniques : </strong>" . htmlspecialchars($produit['NOTESTECH']) . "</p>";
                            echo "<p><strong>Description : </strong>" . htmlspecialchars($produit['DESCRIPTION']) . "</p>";
                            echo "<p><strong>Ingrédients : </strong>" . htmlspecialchars($produit['COMPOSITION']) . "</p>";

                            // Requête caractéristiques (formats et couleurs)
                            $stmt = $conn->prepare('CALL get_dispos_produit(?)');
                            $stmt->execute([$idProduit]);
                            $carac = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            echo "<h3>Formats Disponibles</h3>";
                            $formats = [];
                            foreach ($carac as $car) {
                                if (!in_array($car['NOMFORMAT'], $formats)) {
                                    echo "<button class='btn btn-format'>" . htmlspecialchars($car['NOMFORMAT']) . "</button>";
                                    $formats[] = $car['NOMFORMAT'];
                                }
                            }

                            echo "<h3>Couleurs Disponibles</h3>";
                            $couleurs = [];
                            foreach ($carac as $car) {
                                if (!in_array($car['NOMCOULEUR'], $couleurs)) {
                                    echo "<button class='btn btn-color'>" . htmlspecialchars($car['NOMCOULEUR']) . "</button>";
                                    $couleurs[] = $car['NOMCOULEUR'];
                                }
                            }
                            
                            // Formulaire pour ajout au panier
                            echo "<div class='stock-info'>
                                    <h3>En Stock</h3>
                                    <form action='includes/TraitAjoutPanier.php?idProduit=" . htmlspecialchars($idProduit) . "' method='POST' class='form-inline'>
                                        <input type='number' id='quantite' name='quantite' class='form-control' min='1' step='1' value='1' required onblur='checkNegativeOnBlur(this)'>
                                        <button type='submit' name='action' value='Ajouter au panier' class='btn btn-success ms-2'>Ajouter au panier</button>
                                        <button type='submit' name='action' value='Acheter' class='btn btn-danger ms-2'>Acheter</button>
                                    </form>
                                  </div>";
                        } catch (PDOException $e) {
                            echo "<p class='text-danger'>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
                        }
                    } else {
                        echo "<p class='text-danger'>ID produit manquant ou invalide.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include_once("./includes/footer.php"); ?>

    <script>
        function checkNegativeOnBlur(input) {
            if (input.value < 1) {
                input.value = 1;
            }
        }
    </script>
</body>

</html>