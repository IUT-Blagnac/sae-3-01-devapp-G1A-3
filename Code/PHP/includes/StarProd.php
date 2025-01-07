<?php
// Connexion à la base de données
include 'connect.inc.php';

// Récupérer les 3 meilleurs produits
try {
    $stmtTopProducts = $conn->prepare("
        SELECT 
            p.IDPROD, 
            p.NOMPROD, 
            AVG(c.NBETOILE) AS noteAvg
        FROM 
            COMMENTAIRE c
        JOIN 
            PRODUIT p ON c.IDPROD = p.IDPROD
        GROUP BY 
            p.IDPROD, p.NOMPROD
        ORDER BY 
            noteAvg DESC
        LIMIT 3
    ");
    $stmtTopProducts->execute();
    $topProducts = $stmtTopProducts->fetchAll(PDO::FETCH_ASSOC);
    $stmtTopProducts->closeCursor();
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des produits stars : {$e->getMessage()}</div>";
    die();
}
?>

<!-- Produit stars -->
<div class="container my-5">
    <h1 class="fw-bold text-danger">Nos produits stars</h1>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($topProducts as $index => $product): ?>
                <button
                    type="button"
                    data-bs-target="#carouselExampleIndicators"
                    data-bs-slide-to="<?php echo $index; ?>"
                    class="<?php echo $index === 0 ? 'active' : ''; ?>"
                    aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                    aria-label="Slide <?php echo $index + 1; ?>">
                </button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($topProducts as $index => $product): ?>
                <div class="carousel-item justify-content-center align-items-center <?php echo $index === 0 ? 'active' : ''; ?>">
                    <a href="detailProd.php?idProduit=<?php echo htmlspecialchars($product['IDPROD']); ?>">
                        <img src="./images/produits/image<?php echo htmlspecialchars($product['IDPROD']); ?>.jpeg"
                            class="d-block w-auto"
                            alt="<?php echo htmlspecialchars($product['NOMPROD']); ?>">
                    </a>
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo htmlspecialchars($product['NOMPROD']); ?></h5>
                        <p>Note moyenne : <?php echo number_format($product['noteAvg'], 2); ?> / 10</p>
                    </div>
                </div>
            <?php endforeach; ?>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>
</div>