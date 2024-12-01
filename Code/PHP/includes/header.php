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
          <a class="nav-link fw-bold text-danger" href="#">PRODUITS</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle fw-bold text-danger" href="#" id="navbarDropdown" role="button">
            CATÉGORIES
          </a>
          <div class="dropdown-menu p-3" aria-labelledby="navbarDropdown" style="width: 600px;">
            <div class="row">
              <!-- Colonne 1 -->
              <div class="col-md-4">
                <h6 class="dropdown-header">Catégorie 1</h6>
                <a class="dropdown-item" href="#">Option 1</a>
                <a class="dropdown-item" href="#">Option 2</a>
                <a class="dropdown-item" href="#">Option 3</a>
              </div>
              <!-- Colonne 2 -->
              <div class="col-md-4">
                <h6 class="dropdown-header">Catégorie 2</h6>
                <a class="dropdown-item" href="#">Option 4</a>
                <a class="dropdown-item" href="#">Option 5</a>
                <a class="dropdown-item" href="#">Option 6</a>
              </div>
              <!-- Colonne 3 -->
              <div class="col-md-4">
                <h6 class="dropdown-header">Catégorie 3</h6>
                <a class="dropdown-item" href="#">Option 7</a>
                <a class="dropdown-item" href="#">Option 8</a>
                <a class="dropdown-item" href="#">Option 9</a>
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
          <a class="nav-link fw-bold text-danger" href="Connexion.php">SE CONNECTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="shoppingCart.php">MON PANIER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="shoppingCart.php">PROFIL</a>
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

<!-- CSS personnalisé -->
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
</style>