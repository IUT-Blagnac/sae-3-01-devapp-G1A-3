<!DOCTYPE html>
<html lang="fr">

<?php
require_once 'includes/verif_inactivite.php';
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

    <div class="container mt-5 position-relative">
        <div class="row align-items-center">
            <!-- Colonne pour le texte -->
            <div class="col-md-6 position-relative">
                <h1 class="fw-bold text-danger custom-text">
                    Quand la qualité et la quantité<br>se rencontrent enfin
                </h1>
            </div>
            <!-- Colonne pour l'image -->
            <div class="col-md-6">
                <img src="./images/indexSweets.jpg" alt="Test" class="img-fluid rounded custom-image">
            </div>
        </div>
    </div>
 

    <?php include './includes/StarProd.php' ?>
    
    <?php include './includes/CarCateg.php' ?>

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