<?php
// Connexion à la base de données
include 'connect.inc.php';

// Récupération des catégories depuis la base de données
try {
    $stmtCat = $conn->prepare("SELECT IDCATEG, NOMCATEG FROM CATEGORIE");
    $stmtCat->execute();
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
    $stmtCat->closeCursor();
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur lors de la récupération des catégories : {$e->getMessage()}</div>";
    die();
}

// Diviser les catégories en groupes de 4
$categoriesChunks = array_chunk($categories, 4);
?>

<!-- Carrousel des catégories -->
<div class="container my-5 carcateg">
    <h1 class="fw-bold text-danger">Catégories</h1>
    <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($categoriesChunks as $index => $chunk): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="row">
                        <?php foreach ($chunk as $category): ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <a href="produit.php?id=<?php echo htmlspecialchars($category['IDCATEG']); ?>">
                                        <img src="images/produits/image<?php echo htmlspecialchars($category['IDCATEG']); ?>.jpeg" class="card-img-top" alt="<?php echo htmlspecialchars($category['NOMCATEG']); ?>" width="100%">
                                    </a>
                                    <h5 class="card-title fw-bold text-center"><?php echo htmlspecialchars($category['NOMCATEG']); ?></h5>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#categoriesCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#categoriesCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>