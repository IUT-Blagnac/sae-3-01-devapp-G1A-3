<!DOCTYPE html>
<html lang="fr">

<?php
    session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="website icon" type="png" href="./images/logo/logo.png">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Accueil | SweetShops</title>
</head>

<body style="background-color: #ffe4e1;">
    <?php include './includes/header.php' ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-danger">Quand la qualité et la quantité se rencontrent enfin</h1>
            </div>
            <div class="col">
                <img src="http://placehold.it/380?text=1" alt="Test" style="width:60vh; height:50vh;">
            </div>
        </div>
    </div>
    <!-- Produit stars -->
    <div class="container my-5">
        <h1 class="fw-bold text-danger">Nos produits stars</h1>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href=""><img src="./images/test.jpg" class="d-block w-100" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href=""><img src="./images/test.jpg" class="d-block w-100" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href=""><img src="./images/test.jpg" class="d-block w-100" alt="First slide"></a>
                </div>
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
    <!-- Carrousel des catégories -->
    <div class="container my-5">
        <h1 class="fw-bold text-danger">Catégories</h1>
        <div id="categoriesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=1" class="card-img-top" alt="Catégorie 1"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=2" class="card-img-top" alt="Catégorie 2"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=3" class="card-img-top" alt="Catégorie 3"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=4" class="card-img-top" alt="Catégorie 4"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=5" class="card-img-top" alt="Catégorie 5"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=6" class="card-img-top" alt="Catégorie 6"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=7" class="card-img-top" alt="Catégorie 7"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=8" class="card-img-top" alt="Catégorie 8"></a>
                            </div>
                        </div>
                    </div>
                </div>
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


    <?php include './includes/WishList.php' ?>

    <?php include './includes/AvisRecent.php' ?>

    <?php include './includes/footer.php' ?>
    <script>
        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>