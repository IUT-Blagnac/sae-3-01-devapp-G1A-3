<nav class="navbar navbar-expand-lg" style="background-color: #ffe4e1;">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand" href="#">
      <img src="../images/logo/logo.png" alt="Sweet Shops Logo" height="70" width="100" style="border-radius: 50%;">
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
          <a class="nav-link dropdown-toggle fw-bold text-danger" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CATÉGORIES
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="#">AIDE</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="#">CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="#">SE CONNECTER</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold text-danger" href="#">MON PANIER</a>
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
