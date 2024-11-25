<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <link rel="stylesheet" href="./includes/style.css">
</head>

<body>
    <div class="panier">
        <div class="container">
            <div class="row py-5 align-items-center">
                <!-- Logo -->
                <div class="col-lg-2 col-md-3 col-auto text-center">
                    <a href="index.php">
                        <img src="./images/logo/logo.png" alt="SweetShop Logo" style="width:120px; height:auto;">
                    </a>
                </div>
                <!-- Résumé -->
                <div class="col-lg-10 col-md-9 col text-start">
                    <h3 class="text-uppercase text-pink">Résumé de votre commande</h3>
                </div>
            </div>

            <!-- Progressbar -->
            <ul id="progressbar" class="text-center d-flex justify-content">
                <li class="active" id="step1"><strong>Panier</strong></li>
                <li id="step2"><strong>Livraison</strong></li>
                <li id="step3"><strong>Paiement</strong></li>
                <li id="step4"><strong>Finalisation</strong></li>
            </ul>

            <hr>

            <!-- Contenu de la commande -->
            <div id="step1-content">
                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="text-uppercase text-pink mb-4">Articles de mon panier :</h4>
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <img src="./images/test.jpg" alt="Produit" class="img-fluid" style="max-width: 120px;">
                            <div class="ms-3 flex-grow-1">
                                <p class="mb-1">SweetShop - Bonbons Variés</p>
                                <div class="d-flex align-items-center">
                                    <select class="form-select w-25 me-3" aria-label="Quantité">
                                        <option selected>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                    <button class="btn btn-link text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <span class="text-pink fw-bold">6,95€</span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <h5 class="text-uppercase text-pink mb-3">Résumé de la commande</h5>
                        <table class="table text-end">
                            <tr>
                                <td>Total des articles (Prix initial)</td>
                                <td>6,95€</td>
                            </tr>
                            <tr>
                                <td>Frais de livraison</td>
                                <td>2,50€</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total de la commande</td>
                                <td>9,45€</td>
                            </tr>
                        </table>
                        <button class="btn btn-secondary btn-block mt-3" id="nextToStep2">Valider mon panier</button>
                    </div>
                </div>
            </div>
            <!-- Etape Livraison -->
            <div id="step2-content" style="display:none;">
                <h4 class="text-uppercase text-pink mb-4">Adresse de livraison</h4>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
                </div>
                <button class="btn btn-secondary btn-block mt-3" id="nextToStep3">Continuer au paiement</button>
                <button class="btn btn-secondary btn-block mt-3" id="prevToStep1">Précédent</button>
            </div>

            <!-- Etape Paiement -->
            <div id="step3-content" style="display:none;">
                <h4 class="text-uppercase text-pink mb-4">Détails de paiement</h4>
                <div class="mb-3">
                    <label for="carte" class="form-label">Numéro de carte</label>
                    <input type="text" class="form-control" id="carte" placeholder="Entrez votre numéro de carte">
                </div>
                <div class="mb-3">
                    <label for="expiration" class="form-label">Date d'expiration</label>
                    <input type="text" class="form-control" id="expiration" placeholder="MM/AA">
                </div>
                <div class="mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="CVV">
                </div>
                <button class="btn btn-secondary btn-block mt-3" id="nextToStep4">Finaliser la commande</button>
                <button class="btn btn-secondary btn-block mt-3" id="prevToStep2">Précédent</button>
            </div>

            <!-- Etape Finalisation -->
            <div id="step4-content" style="display:none;">
                <h4 class="text-uppercase text-pink mb-4">Confirmation de commande</h4>
                <p>Merci pour votre commande !</p>
                <button class="btn btn-secondary btn-block mt-3" id="prevToStep3">Précédent</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var currentIndex = 0; // Indice de l'étape actuelle dans la barre de progression

            // Fonction pour aller à l'étape suivante
            function goToNextStep(currentStep, nextStep) {
                $(currentStep).hide(); // Masquer l'étape actuelle
                $(nextStep).show(); // Afficher l'étape suivante

                $("#progressbar li").eq(currentIndex).removeClass("active"); // Désactiver l'étape actuelle
                currentIndex++; // Passer à l'étape suivante
                $("#progressbar li").eq(currentIndex).addClass("active"); // Activer l'étape suivante
            }

            // Fonction pour revenir à l'étape précédente
            function goToPreviousStep(currentStep, previousStep) {
                $(currentStep).hide(); // Masquer l'étape actuelle
                $(previousStep).show(); // Afficher l'étape précédente

                $("#progressbar li").eq(currentIndex).removeClass("active"); // Désactiver l'étape actuelle
                currentIndex--; // Revenir à l'étape précédente
                $("#progressbar li").eq(currentIndex).addClass("active"); // Activer l'étape précédente
            }

            // Navigation entre les étapes
            $('#nextToStep2').click(function() {
                goToNextStep('#step1-content', '#step2-content');
            });

            $('#nextToStep3').click(function() {
                goToNextStep('#step2-content', '#step3-content');
            });

            $('#nextToStep4').click(function() {
                goToNextStep('#step3-content', '#step4-content');
            });

            // Navigation en arrière
            $('#prevToStep1').click(function() {
                goToPreviousStep('#step2-content', '#step1-content');
            });

            $('#prevToStep2').click(function() {
                goToPreviousStep('#step3-content', '#step2-content');
            });

            $('#prevToStep3').click(function() {
                goToPreviousStep('#step4-content', '#step3-content');
            });
        });
    </script>
</body>

</html>