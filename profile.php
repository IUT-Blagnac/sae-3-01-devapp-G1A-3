<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Profil Utilisateur</title>
</head>

<body style="background-color: #ffe4e1; font-family: 'Arial', sans-serif;">

    <?php include_once './includes/header.php'; ?>
    
    <section class="profile-wrapper mt-5 mx-auto my-5" style="max-width: 900px;">
        <div class="profile-header">
            <div class="profile-cover-photo" style="background-image: url('./images/test.jpg');"></div>
            <div class="profile-author d-sm-flex flex-row-reverse justify-content-between align-items-end">
                <div class="profile-photo">
                    <img src="./images/test.jpg" alt="Photo de profil" width="120" height="120">
                </div>
                <div class="profile-name">
                    <h4 class="name">John Doe Nick</h4>
                    <p class="email">doe@email.com</p>
                </div>
            </div>
        </div>

        <div class="profile-body mt-4">
            <div class="profile-title d-flex justify-content-between align-items-center">
                <h5 class="title">Détails Personnels</h5>
                <a class="profile-link" href="#">Modifier</a>
            </div>
            <div class="profile-details">
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Nom Complet :</h6>
                    </div>
                    <div class="details-content">
                        <p>John Doe Nick</p>
                    </div>
                </div>
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Email :</h6>
                    </div>
                    <div class="details-content">
                        <p>doe@email.com</p>
                    </div>
                </div>
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Téléphone :</h6>
                    </div>
                    <div class="details-content">
                        <p>+123 456 789 0234</p>
                    </div>
                </div>
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Adresse :</h6>
                    </div>
                    <div class="details-content">
                        <p>Company Inc., 8901 Marmora Road, Glasgow, D04 89GR.</p>
                    </div>
                </div>
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Sexe :</h6>
                    </div>
                    <div class="details-content">
                        <p>Homme</p>
                    </div>
                </div>
                <div class="single-details-item d-flex">
                    <div class="details-title">
                        <h6>Date de naissance :</h6>
                    </div>
                    <div class="details-content">
                        <p>04 Janvier 1992</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Points de Fidélité -->
        <div class="profile-footer mt-5">
            <div class="profile-title d-flex justify-content-between align-items-center">
                <h5 class="title">Points de Fidélité</h5>
                <a class="profile-link" href="#">Utiliser des points</a>
            </div>
            <div class="profile-loyalty-info">
                <div class="row">
                    <div class="col-md-6 col-sm-6 mb-3">
                        <div class="single-loyalty-info">
                            <h6 class="loyalty-title">Points Disponibles</h6>
                            <p class="loyalty-value">120 Points</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 mb-3">
                        <div class="single-loyalty-info">
                            <h6 class="loyalty-title">Points Utilisés</h6>
                            <p class="loyalty-value">30 Points</p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                        <div class="single-loyalty-info">
                            <h6 class="loyalty-title">Solde des Points</h6>
                            <p class="loyalty-value">90 Points Restants</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a class="btn btn-custom" href="#">Échanger contre des réductions</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Cartes -->
        <div class="profile-footer mt-5">
            <div class="profile-title d-flex justify-content-between align-items-center">
                <h5 class="title">Cartes</h5>
                <a class="profile-link" href="#">Ajouter une carte</a>
            </div>
            <div class="profile-card-info">
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="single-card-info d-flex">
                            <img src="./images/visa.png" alt="Visa">
                            <div class="card-info ms-3">
                                <h5 class="card-name">Musa Ahmed</h5>
                                <p class="card-number">.... 4534 <span>02/20</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="single-card-info d-flex">
                            <img src="./images/american-express.png" alt="American Express">
                            <div class="card-info ms-3">
                                <h5 class="card-name">Musa Ahmed</h5>
                                <p class="card-number">.... 4534 <span>02/20</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <div class="single-card-info d-flex">
                            <img src="./images/mastercard.png" alt="Mastercard">
                            <div class="card-info ms-3">
                                <h5 class="card-name">Musa Ahmed</h5>
                                <p class="card-number">.... 4534 <span>02/20</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</body>

</html>
