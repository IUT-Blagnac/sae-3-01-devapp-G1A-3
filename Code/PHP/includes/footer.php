<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Accueil</title>
</head>

<body style="background-color: #ffe4e1;">
    <!-- Votre contenu de page ici -->

    <div class="container footer-container" id="footer">
        <footer class="py-5">
            <div class="row">
                <div class="col-6 col-md-2 mb-3">
                    <h5 class="fw-bold text-danger">Support</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="FAQ.php" class="nav-link p-0 text-muted">FAQ</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Contact</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Signaler un problème</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5 class="fw-bold text-danger">À propos de nous</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Notre Histoire</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Nos magasins</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Quelques chiffres</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-2 mb-3">
                    <h5 class="fw-bold text-danger">Site web</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Nos produits stars</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Catégories</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Liste de souhaits</a></li>
                    </ul>
                </div>
                <!-- Section newletters qui à quoi en soit ? -->
                <div class="col-md-5 offset-md-1 mb-3">
                    <form>
                        <h5 class="fw-bold text-danger">Abonnez-vous à nos Newsletters</h5>
                        <p>Restez à l'affût des dernières nouvelles de SweetShops !</p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Adresse mail</label>
                            <input id="newsletter1" type="email" class="form-control" placeholder="Adresse mail">
                            <button class="btn btn-primary" type="button">S'abonner</button>
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-between">
                    <p>© 2024 SweetShops, Tous droits réservés.</p>
                    <ul class="list-unstyled d-flex">
                        <li class="ms-3"><a class="link-dark" href="#"><i class="bi bi-facebook" style="font-size: 24px;"></i></a></li>
                        <li class="ms-3"><a class="link-dark" href="#"><i class="bi bi-instagram" style="font-size: 24px;"></i></a></li>
                        <li class="ms-3"><a class="link-dark" href="#"><i class="bi bi-twitter" style="font-size: 24px;"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <script>
        window.addEventListener('scroll', function () {
            const footer = document.getElementById('footer');
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const windowHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;

            if (scrollTop + windowHeight >= docHeight) {
                footer.classList.add('show');
            } else {
                footer.classList.remove('show');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
