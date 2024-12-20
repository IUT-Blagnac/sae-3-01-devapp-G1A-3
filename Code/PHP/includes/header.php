<nav class="navbar navbar-expand-lg" style="background-color: #ffe4e1;">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="index.php">
      <img src="./images/logo/logo.png" alt="Sweet Shops Logo" height="70" width="100" style="border-radius: 50%;">
    </a>

    <!-- Bouton mobile pour le menu -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu principal -->
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="produit.php">PRODUITS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-danger" href="#" id="navbarDropdown" role="button">
            CATÉGORIES
          </a>
          <div class="dropdown-menu p-3" aria-labelledby="navbarDropdown" style="width: 600px;">
            <div class="row">
              <!-- Colonne 1 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">Gélifiés</h6>
                </a>
              </div>
              <!-- Colonne 2 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">Artisanaux</h6>
                </a>
              </div>
              <!-- Colonne 3 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">K'rokante</h6>
                </a>
              </div>
              <!-- Colonne 4 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">Vegandy</h6>
                </a>
              </div>
              <!-- Colonne 5 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">ChoupiPop</h6>
                </a>
              </div>
              <!-- Colonne 6 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">ChocoBoom</h6>
                </a>
              </div>
              <!-- Colonne 7 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">Praloup</h6>
                </a>
              </div>
              <!-- Colonne 8 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">ChocoCraq</h6>
                </a>
              </div>
              <!-- Colonne 9 -->
              <div class="col-md-4">
                <a href="">
                  <h6 class="dropdown-header">Fondoo</h6>
                </a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="FAQ.php">AIDE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="#">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="shoppingCart.php">MON PANIER</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-danger" href="#" id="navbarDropdown" role="button">
            COMPTE
          </a>
          <div class="dropdown-menu p-3" aria-labelledby="navbarDropdown" style="width: 450px;">
            <div class="row row-cols-1 g-3">
              <!-- Colonne 1 -->
              <div class="col">
                <a href="profile.php" class="dropdown-item">
                  <h6 class="dropdown-header">Vos Informations personnelles</h6>
                </a>
              </div>
              <!-- Colonne 2 -->
              <div class="col">
                <a href="#" class="dropdown-item">
                  <h6 class="dropdown-header">Vos Commandes</h6>
                </a>
              </div>
              <!-- Colonne 3 -->
              <div class="col">
                <a href="Connexion.php" class="dropdown-item">
                  <h6 class="dropdown-header">Se Connecter</h6>
                </a>
              </div>
              <!-- Colonne 4 -->
              <div class="col">
                <a href="#" class="dropdown-item">
                  <h6 class="dropdown-header">Se Déconnecter</h6>
                </a>
              </div>
            </div>
          </div>
        </li>
      </ul>

      <!-- Barre de recherche -->
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Rechercher" style="border-radius: 20px; border: none;">
        <button class="btn" type="submit" style="background-color: transparent; color: #d0006f;">
          <i class="bi bi-search" style="font-size: 1.5rem;"></i>
        </button>
      </form>
    </div>
  </div>
</nav>

<!-- CSS personnalisé pour le menu-->
<style>
  /* Afficher le menu dropdown au survol */
  .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    margin-top: 0;
    /* Ajuste l'alignement pour éviter les décalages */
  }

  /* Transition fluide */
  .dropdown-menu {
    display: none;
    opacity: 0;
    transition: opacity 0.3s ease;
    width: 600px;
    /* Ajustez selon vos besoins */
    padding: 20px;
    /* Espacement interne */
    background-color: #ffe4e1;
    /* Couleur de fond */
    border: 1px solid #d0006f;
    /* Bordure */
  }

  .nav-item.dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
  }

  .dropdown-menu .col-md-4 {
    padding-left: 10px;
    padding-right: 10px;
  }

  .dropdown-header {
    font-weight: bold;
    font-size: 1.2em;
    text-transform: uppercase;
    /* color: #d0006f; à corriger */
  }
</style>