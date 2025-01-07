<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Contactez-nous | SweetShops</title>
</head>

<body style="background-color: #f8f9fa;">
    <!-- Header -->
    <header style="background-color: #C4026E; color: white;" class="py-4">
        <div class="container text-center">
            <h1 class="fw-bold">Contactez-nous</h1>
            <p>Nous sommes là pour répondre à toutes vos questions</p>
        </div>
    </header>

    <!-- Formulaire de contact -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center" style="color: #C4026E; margin-bottom: 20px;">Envoyez-nous un message</h2>
                        <form action="process_contact.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet de votre message">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Écrivez votre message ici" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg text-white" style="background-color: #C4026E;">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informations de contact -->
    <div class="container my-5">
        <div class="row text-center">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-envelope-fill" style="color: #C4026E; font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Email</h5>
                        <p>contact@sweetshops.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-telephone-fill" style="color: #C4026E; font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Téléphone</h5>
                        <p>+33 1 23 45 67 89</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill" style="color: #C4026E; font-size: 2rem;"></i>
                        <h5 class="card-title mt-3">Adresse</h5>
                        <p>123 Rue des Douceurs, Paris, France</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">&copy; 2025 SweetShops - Tous droits réservés.</p>
    </footer>
</body>

</html>
